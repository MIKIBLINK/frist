<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "seavlinh_shop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Filters & Pagination ---
$search = $_GET['search'] ?? '';
$status_filter = $_GET['status'] ?? '';
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 8;
$offset = ($page - 1) * $limit;

// --- Build WHERE conditions using prepared statements ---
$where = [];
$params = [];
$types = '';

if (!empty($search)) {
    $where[] = "(o.id LIKE ? OR u.name LIKE ? OR u.phone_number LIKE ?)";
    $params[] = "%" . $search . "%";
    $params[] = "%" . $search . "%";
    $params[] = "%" . $search . "%";
    $types .= "sss";
}

if (!empty($status_filter) && in_array($status_filter, ['Pending', 'Transporting', 'Complete'])) {
    $where[] = "o.status = ?";
    $params[] = $status_filter;
    $types .= "s";
}

$where_clause = count($where) > 0 ? "WHERE " . implode(' AND ', $where) : "";

// --- Count total ---
$total_sql = "SELECT COUNT(*) as total FROM orders o JOIN users u ON o.user_id = u.id " . $where_clause;
$stmt_total = $conn->prepare($total_sql);
if ($stmt_total) {
    if (!empty($params)) {
        $stmt_total->bind_param($types, ...$params);
    }
    $stmt_total->execute();
    $total_rows = $stmt_total->get_result()->fetch_assoc()['total'];
    $stmt_total->close();
} else {
    $total_rows = 0;
}
$total_pages = ceil($total_rows / $limit);

// --- Get Orders ---
$sql = "SELECT o.id AS order_id, u.name AS customer_name, u.phone_number, u.address,
        o.order_details, o.total_amount, o.payment_method, o.status, o.order_date
        FROM orders o
        JOIN users u ON o.user_id = u.id
        $where_clause
        ORDER BY o.order_date DESC
        LIMIT ? OFFSET ?";
$stmt_orders = $conn->prepare($sql);
if ($stmt_orders) {
    // Add pagination params
    $params_orders = array_merge($params, [$limit, $offset]);
    $types_orders = $types . "ii";

    $stmt_orders->bind_param($types_orders, ...$params_orders);
    $stmt_orders->execute();
    $result = $stmt_orders->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);
    $stmt_orders->close();
} else {
    $orders = [];
}

// --- KPIs ---
$kpi = $conn->query("
    SELECT SUM(total_amount) as revenue,
    COUNT(*) as total,
    SUM(CASE WHEN status='Pending' THEN 1 ELSE 0 END) as pending
    FROM orders
")->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .status-Pending {
        background: #f97316;
    }

    .status-Transporting {
        background: #3b82f6;
    }

    .status-Complete {
        background: #10b981;
    }

    .sidebar-nav li a.active,
    .sidebar-nav li.active a {
        @apply bg-blue-600 border-l-4 border-blue-200 pl-[21px] text-white;
    }
    </style>
</head>

<body class="bg-gray-100 flex page-admin-orders">
    <?php include './sidebar/admin_sidebar.php'; ?>

    <main class="flex-grow p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Order Management</h1>
            <div>
                Welcome, <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong> |
                <a href="logout.php" class="text-red-500">Logout</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="flex items-center bg-white p-6 rounded-xl shadow">
                <div class="p-4 rounded-full mr-4 bg-green-500 text-white text-3xl"><i class="fas fa-dollar-sign"></i>
                </div>
                <div>
                    <div class="text-4xl font-bold">$<?php echo number_format($kpi['revenue'] ?? 0, 2); ?></div>
                    <div>Total Revenue</div>
                </div>
            </div>
            <div class="flex items-center bg-white p-6 rounded-xl shadow">
                <div class="p-4 rounded-full mr-4 bg-blue-500 text-white text-3xl"><i class="fas fa-receipt"></i></div>
                <div>
                    <div class="text-4xl font-bold"><?php echo $kpi['total']; ?></div>
                    <div>Total Orders</div>
                </div>
            </div>
            <div class="flex items-center bg-white p-6 rounded-xl shadow">
                <div class="p-4 rounded-full mr-4 bg-orange-500 text-white text-3xl"><i
                        class="fas fa-hourglass-half"></i></div>
                <div>
                    <div class="text-4xl font-bold"><?php echo $kpi['pending']; ?></div>
                    <div>Pending Orders</div>
                </div>
            </div>
        </div>

        <form method="get" class="flex flex-wrap gap-4 mb-6">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
                placeholder="Search by name/phone/order id" class="p-2 border rounded-md flex-grow" />
            <select name="status" class="p-2 border rounded-md">
                <option value="">All Status</option>
                <?php foreach (['Pending', 'Transporting', 'Complete'] as $st): ?>
                <option value="<?php echo htmlspecialchars($st); ?>"
                    <?php echo $status_filter == $st ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($st); ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button class="px-4 py-2 bg-blue-600 text-white rounded-md">Filter</button>
        </form>

        <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Order ID</th>
                        <th class="px-4 py-3 text-left">Customer</th>
                        <th class="px-4 py-3 text-left">Items</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Payment</th>
                        <th class="px-4 py-3 text-left">Address</th>
                        <th class="px-4 py-3 text-left">Date</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($orders):
                        foreach ($orders as $o): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-semibold">#<?php echo htmlspecialchars($o['order_id']); ?></td>
                        <td class="px-4 py-3">
                            <strong><?php echo htmlspecialchars($o['customer_name']); ?></strong><br>
                            <small class="text-gray-500"><?php echo htmlspecialchars($o['phone_number']); ?></small>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <?php
                                $items = json_decode($o['order_details'], true);
                                if ($items) {
                                    foreach ($items as $it) {
                                        echo htmlspecialchars($it['quantity']) . "x " . htmlspecialchars($it['name']) . "<br>";
                                    }
                                } else {
                                    echo "N/A";
                                }
                            ?>
                        </td>
                        <td class="px-4 py-3">$<?php echo number_format($o['total_amount'], 2); ?></td>
                        <td class="px-4 py-3"><?php echo htmlspecialchars($o['payment_method']); ?></td>
                        <td class="px-4 py-3">
                            <a href="https://maps.google.com/?q=<?php echo urlencode($o['address']); ?>"
                                class="text-blue-600" target="_blank">Map</a>
                        </td>
                        <td class="px-4 py-3"><?php echo date("M d, Y", strtotime($o['order_date'])); ?></td>
                        <td class="px-4 py-3">
                            <span
                                class="px-3 py-1 rounded-full text-white text-xs status-<?php echo htmlspecialchars($o['status']); ?>">
                                <?php echo htmlspecialchars($o['status']); ?>
                            </span>
                            <select data-order-id="<?php echo htmlspecialchars($o['order_id']); ?>"
                                class="order-status-select mt-2 p-1 border rounded-md text-xs">
                                <?php foreach (['Pending', 'Transporting', 'Complete'] as $st): ?>
                                <option value="<?php echo htmlspecialchars($st); ?>"
                                    <?php echo $o['status'] == $st ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($st); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div id="status-msg-<?php echo htmlspecialchars($o['order_id']); ?>" class="text-xs mt-1">
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-8 text-gray-500">No orders found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center gap-2">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&status=<?php echo urlencode($status_filter); ?>"
                class="px-3 py-1 border rounded <?php echo $page == $i ? 'bg-blue-600 text-white' : ''; ?>">
                <?php echo $i; ?>
            </a>
            <?php endfor; ?>
        </div>
    </main>

    <script>
    document.querySelectorAll('.order-status-select').forEach(el => {
        el.addEventListener('change', async (e) => {
            const id = e.target.dataset.orderId;
            const status = e.target.value;
            const msg = document.getElementById('status-msg-' + id);
            msg.textContent = "Updating...";
            msg.className = "text-gray-600 text-xs mt-1";
            try {
                const res = await fetch('update_order_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `order_id=${id}&new_status=${status}`
                });
                const data = await res.json();
                if (data.success) {
                    msg.textContent = "Updated!";
                    msg.className = "text-green-600 text-xs mt-1";
                    // Update the visible status badge immediately
                    const statusBadge = e.target.closest('td').querySelector(
                        '.px-3.py-1.rounded-full');
                    statusBadge.textContent = status;
                    statusBadge.className =
                        `px-3 py-1 rounded-full text-white text-xs status-${status}`;
                } else {
                    msg.textContent = "Error: " + data.message;
                    msg.className = "text-red-600 text-xs mt-1";
                }
            } catch (error) {
                msg.textContent = "Network error: " + error.message;
                msg.className = "text-red-600 text-xs mt-1";
            }
            setTimeout(() => msg.textContent = "", 3000);
        });
    });
    </script>
</body>

</html>