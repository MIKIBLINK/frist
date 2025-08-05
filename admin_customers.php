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

$sql = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
$users = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin Panel - Customer Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-nav li a.active,
        .sidebar-nav li.active a {
            @apply bg-blue-600 border-l-4 border-blue-200 pl-[21px] text-white;
        }
    </style>
</head>

<body class="bg-gray-100 flex">
    <div class="flex w-full min-h-screen">
        <?php include 'admin_sidebar.php'; ?>

        <main class="main-content flex-grow p-8 overflow-y-auto">
            <header class="header flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold">Customer Management</h1>
                <div class="user-info flex items-center font-medium">
                    <span class="mr-4 text-gray-700">Welcome,
                        <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong></span>
                    <a href="logout.php"
                        class="text-red-500 no-underline font-semibold hover:text-red-600 transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout</a>
                </div>
            </header>

            <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow-md overflow-hidden">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Phone Number</th>
                            <th class="py-3 px-6 text-left">Address</th>
                            <th class="py-3 px-6 text-left">Created At</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($users): ?>
                            <?php foreach ($users as $u): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left"><?php echo $u['id']; ?></td>
                                    <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($u['name']); ?></td>
                                    <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($u['phone_number']); ?></td>
                                    <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($u['address']); ?></td>
                                    <td class="py-3 px-6 text-left">
                                        <?php echo date("M d, Y H:i", strtotime($u['created_at'])); ?>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <a href="edit_customer.php?id=<?php echo $u['id']; ?>"
                                            class="text-blue-600 hover:underline mr-4">Edit</a>
                                        <a href="delete_customer.php?id=<?php echo $u['id']; ?>"
                                            onclick="return confirm('Delete this customer?');"
                                            class="text-red-600 hover:underline">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">No customers found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="add_customer.php"
                    class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Add New Customer</a>
            </div>
        </main>
    </div>
</body>


</html>
