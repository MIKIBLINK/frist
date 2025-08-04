<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "seavlinh_shop";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Order Status counts
$sqlStatus = "SELECT status, COUNT(*) as count FROM orders GROUP BY status";
$resultStatus = $conn->query($sqlStatus);

$statusCounts = ['Pending' => 0, 'Transporting' => 0, 'Complete' => 0];
$totalOrders = 0;

if ($resultStatus && $resultStatus->num_rows > 0) {
    while ($row = $resultStatus->fetch_assoc()) {
        $status = $row['status'];
        $count = (int) $row['count'];
        if (isset($statusCounts[$status])) {
            $statusCounts[$status] = $count;
            $totalOrders += $count;
        }
    }
}

// 2. Payment Methods counts
$sqlPayment = "SELECT payment_method, COUNT(*) as count FROM orders GROUP BY payment_method";
$resultPayment = $conn->query($sqlPayment);

$paymentCounts = [];
if ($resultPayment && $resultPayment->num_rows > 0) {
    while ($row = $resultPayment->fetch_assoc()) {
        $paymentCounts[$row['payment_method']] = (int) $row['count'];
    }
}

// 3. Orders by day (last 7 days)
$sqlOrdersDay = "SELECT DATE(order_date) AS order_day, COUNT(*) AS count
                 FROM orders
                 WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
                 GROUP BY order_day
                 ORDER BY order_day ASC";
$resultOrdersDay = $conn->query($sqlOrdersDay);

$ordersDayCounts = [];
for ($i = 6; $i >= 0; $i--) {
    $dateKey = date('Y-m-d', strtotime("-$i days"));
    $ordersDayCounts[$dateKey] = 0;
}
if ($resultOrdersDay && $resultOrdersDay->num_rows > 0) {
    while ($row = $resultOrdersDay->fetch_assoc()) {
        $ordersDayCounts[$row['order_day']] = (int) $row['count'];
    }
}

// 4. Orders by week (last 4 weeks)
$sqlOrdersWeek = "SELECT YEAR(order_date) AS year, WEEK(order_date, 1) AS week, COUNT(*) AS count
                 FROM orders
                 WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 28 DAY)
                 GROUP BY year, week
                 ORDER BY year, week ASC";
$resultOrdersWeek = $conn->query($sqlOrdersWeek);

$ordersWeekCounts = [];
// Generate last 4 weeks keys
for ($i = 3; $i >= 0; $i--) {
    $weekDate = new DateTime();
    $weekDate->modify("-$i week");
    $year = $weekDate->format("Y");
    $week = $weekDate->format("W");
    $key = $year . "-W" . $week;
    $ordersWeekCounts[$key] = 0;
}
if ($resultOrdersWeek && $resultOrdersWeek->num_rows > 0) {
    while ($row = $resultOrdersWeek->fetch_assoc()) {
        $key = $row['year'] . "-W" . str_pad($row['week'], 2, "0", STR_PAD_LEFT);
        if (isset($ordersWeekCounts[$key])) {
            $ordersWeekCounts[$key] = (int) $row['count'];
        }
    }
}

// 5. Orders by month (last 6 months)
$sqlOrdersMonth = "SELECT DATE_FORMAT(order_date, '%Y-%m') AS order_month, COUNT(*) AS count
                    FROM orders
                    WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 5 MONTH)
                    GROUP BY order_month
                    ORDER BY order_month ASC";
$resultOrdersMonth = $conn->query($sqlOrdersMonth);

$ordersMonthCounts = [];
// Generate last 6 months keys
for ($i = 5; $i >= 0; $i--) {
    $monthKey = date('Y-m', strtotime("-$i month"));
    $ordersMonthCounts[$monthKey] = 0;
}
if ($resultOrdersMonth && $resultOrdersMonth->num_rows > 0) {
    while ($row = $resultOrdersMonth->fetch_assoc()) {
        $ordersMonthCounts[$row['order_month']] = (int) $row['count'];
    }
}

// 6. Total revenue
$sqlRevenue = "SELECT SUM(total_amount) AS total_revenue FROM orders";
$resultRev = $conn->query($sqlRevenue);
$totalRevenue = 0;
if ($resultRev && $resultRev->num_rows > 0) {
    $row = $resultRev->fetch_assoc();
    $totalRevenue = (float) $row['total_revenue'];
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard-Seavling Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-nav li.active a {
            @apply bg-blue-600 border-l-4 border-blue-200 pl-[21px] text-white;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 flex">
    <div class="flex w-full min-h-screen">
        <?php include './sidebar/admin_sidebar.php'; ?>

        <main class="main-content flex-grow p-8 overflow-y-auto">
            <header class="header flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <div class="user-info flex items-center font-medium">
                    <span class="mr-4 text-gray-700">Welcome,
                        <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong></span>
                    <a href="logout.php"
                        class="text-red-500 no-underline font-semibold hover:text-red-600 transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout</a>
                </div>
            </header>

            <div class="kpi-container grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <div class="kpi-card flex items-center bg-white p-6 rounded-xl shadow-md">
                    <div class="icon text-3xl p-4 rounded-full mr-4 bg-green-500 text-white">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="details">
                        <div class="value text-4xl font-bold text-gray-900">
                            $<?php echo number_format($totalRevenue, 2); ?>
                        </div>
                        <div class="title text-sm text-gray-500">Total Revenue</div>
                    </div>
                </div>
                <div class="kpi-card flex items-center bg-white p-6 rounded-xl shadow-md">
                    <div class="icon text-3xl p-4 rounded-full mr-4 bg-blue-500 text-white">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="details">
                        <div class="value text-4xl font-bold text-gray-900"><?php echo $totalOrders; ?></div>
                        <div class="title text-sm text-gray-500">Total Orders</div>
                    </div>
                </div>
                <div class="kpi-card flex items-center bg-white p-6 rounded-xl shadow-md">
                    <div class="icon text-3xl p-4 rounded-full mr-4 bg-orange-500 text-white">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="details">
                        <div class="value text-4xl font-bold text-gray-900"><?php echo $statusCounts['Pending']; ?>
                        </div>
                        <div class="title text-sm text-gray-500">Pending Orders</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <section class="bg-white rounded-xl p-8 shadow-md">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Orders Over Time</h2>
                        <select id="timeRangeSelect" class="border border-gray-300 rounded px-3 py-1 cursor-pointer">
                            <option value="day" selected>Last 7 Days (Day)</option>
                            <option value="week">Last 4 Weeks (Week)</option>
                            <option value="month">Last 6 Months (Month)</option>
                        </select>
                    </div>
                    <canvas id="ordersTimeChart" height="300"></canvas>
                </section>

                <section class="bg-white rounded-xl p-8 shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Payment Methods Distribution</h2>
                    <canvas id="paymentMethodsChart" height="300"></canvas>
                </section>
            </div>
        </main>
    </div>

    <script>
        // Prepare data for payment chart from PHP
        const paymentLabels = <?php echo json_encode(array_keys($paymentCounts)); ?>;
        const paymentData = <?php echo json_encode(array_values($paymentCounts)); ?>;

        // Generate distinct colors for payment methods
        const paymentColors = [
            'rgba(59, 130, 246, 0.8)', // Blue
            'rgba(16, 185, 129, 0.8)', // Green
            'rgba(234, 88, 12, 0.8)', // Orange
            'rgba(220, 38, 38, 0.8)', // Red
            'rgba(168, 85, 247, 0.8)', // Purple
        ];

        const paymentCtx = document.getElementById('paymentMethodsChart').getContext('2d');
        const paymentChart = new Chart(paymentCtx, {
            type: 'doughnut',
            data: {
                labels: paymentLabels,
                datasets: [{
                    label: 'Payment Methods',
                    data: paymentData,
                    backgroundColor: paymentColors.slice(0, paymentLabels.length),
                    borderColor: 'white',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => `${ctx.label}: ${ctx.parsed} orders`
                        }
                    }
                }
            }
        });

        const ctx = document.getElementById('ordersTimeChart').getContext('2d');

        // PHP data for charts
        const dataDay = {
            labels: <?php echo json_encode(array_map(function ($d) {
                return date('M d', strtotime($d));
            }, array_keys($ordersDayCounts))); ?>,
            data: <?php echo json_encode(array_values($ordersDayCounts)); ?>
        };

        const dataWeek = {
            labels: <?php echo json_encode(array_keys($ordersWeekCounts)); ?>,
            data: <?php echo json_encode(array_values($ordersWeekCounts)); ?>
        };

        const dataMonth = {
            labels: <?php echo json_encode(array_map(function ($m) {
                return date('M Y', strtotime($m . '-01'));
            }, array_keys($ordersMonthCounts))); ?>,
            data: <?php echo json_encode(array_values($ordersMonthCounts)); ?>
        };

        // Initial chart config
        let chartConfig = {
            type: 'bar',
            data: {
                labels: dataDay.labels,
                datasets: [{
                    label: 'Orders',
                    data: dataDay.data,
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => `${ctx.parsed.y} orders`
                        }
                    }
                }
            }
        };

        let ordersTimeChart = new Chart(ctx, chartConfig);

        // Update chart on select change
        document.getElementById('timeRangeSelect').addEventListener('change', (e) => {
            let val = e.target.value;
            let labels, data;

            if (val === 'day') {
                labels = dataDay.labels;
                data = dataDay.data;
            } else if (val === 'week') {
                labels = dataWeek.labels;
                data = dataWeek.data;
            } else if (val === 'month') {
                labels = dataMonth.labels;
                data = dataMonth.data;
            }

            ordersTimeChart.data.labels = labels;
            ordersTimeChart.data.datasets[0].data = data;
            ordersTimeChart.update();
        });
    </script>
</body>

</html>