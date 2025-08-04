<?php
include 'db.php';

$orders = [];
$user = null;

if (isset($_GET['phone_number']) && !empty($_GET['phone_number'])) {
    // The prepared statement already handles escaping, so real_escape_string is not needed here.
    $phoneNumber = $_GET['phone_number'];

    // Get user info
    $stmt = $conn->prepare("SELECT id, name FROM users WHERE phone_number = ?");
    $stmt->bind_param("s", $phoneNumber);
    $stmt->execute();
    $userResult = $stmt->get_result();

    if ($userResult->num_rows > 0) {
        $user = $userResult->fetch_assoc();
        $userId = $user['id'];

        // Get orders for user
        // FIX: Added 'id' to the SELECT statement to resolve the undefined array key warning.
        // Also updated the ORDER BY clause to sort by order ID (number)
        $orderStmt = $conn->prepare("SELECT id, order_details, total_amount, payment_method, status, order_date FROM orders WHERE user_id = ? ORDER BY id DESC");
        $orderStmt->bind_param("i", $userId);
        $orderStmt->execute();
        $ordersResult = $orderStmt->get_result();
        $orders = $ordersResult->fetch_all(MYSQLI_ASSOC);
        $orderStmt->close();
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center text-primary mb-4">Your Order History</h1>

        <form method="GET" class="d-flex justify-content-center mb-4">
            <input type="tel" class="form-control w-50" name="phone_number" placeholder="Enter phone number" required>
            <button class="btn btn-primary ms-2">View</button>
        </form>

        <?php if (isset($_GET['phone_number'])): ?>
        <?php if ($user): ?>
        <h3 class="text-center mb-4">Orders for <?= htmlspecialchars($user['name']) ?>
            (<?= htmlspecialchars($_GET['phone_number']) ?>)</h3>

        <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Order Number: <?= htmlspecialchars($order['id']) ?></h5>
                <p><strong>Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
                <p><strong>Total Amount:</strong> $<?= number_format($order['total_amount'], 2) ?></p>
                <p><strong>Payment:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
                <p><strong>Status:</strong>
                    <?php if ($order['status'] == 'Pending'): ?>
                    <span class="badge bg-warning text-dark">Pending</span>
                    <?php elseif ($order['status'] == 'Transporting'): ?>
                    <span class="badge bg-info text-dark">Transporting</span>
                    <?php else: ?>
                    <span class="badge bg-success">Complete</span>
                    <?php endif; ?>
                </p>

                <hr>
                <h6>Items:</h6>
                <?php
                                $items = json_decode($order['order_details'], true);
                                if (!empty($items)): ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($items as $item): ?>
                    <li class="list-group-item">
                        <?= htmlspecialchars($item['name']) ?>
                        (Qty: <?= htmlspecialchars($item['quantity']) ?>) -
                        $<?= number_format($item['price'], 2) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <p>No items found for this order.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-center text-muted">No orders found for this phone number.</p>
        <?php endif; ?>
        <?php else: ?>
        <p class="text-center text-muted">No user found with that phone number.</p>
        <?php endif; ?>
        <?php else: ?>
        <p class="text-center text-muted">Please enter a phone number to view your orders.</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-outline-primary">Back to Home</a>
            <button onclick="location.reload()" class="btn btn-secondary ms-2">Refresh</button>
        </div>
    </div>
</body>

</html>