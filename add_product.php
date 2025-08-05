<?php
// Start the session to check for admin login
session_start();

// Redirect to login page if the admin is not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Database connection details
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "seavlinh_shop";

// Create a new database connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate form inputs
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = filter_var(trim($_POST['price']), FILTER_VALIDATE_FLOAT);
    $stock = filter_var(trim($_POST['stock']), FILTER_VALIDATE_INT);

    // Basic server-side validation
    $errors = [];
    if (empty($name)) {
        $errors[] = "Product name is required.";
    }
    if (empty($description)) {
        $errors[] = "Description is required.";
    }
    if ($price === false || $price < 0) {
        $errors[] = "Price must be a valid number.";
    }
    if ($stock === false || $stock < 0) {
        $errors[] = "Stock must be a valid non-negative integer.";
    }

    // If there are no validation errors, proceed with insertion
    if (empty($errors)) {
        // Use a prepared statement to prevent SQL injection
        $sql = "INSERT INTO products (name, description, price, stock, created_at) VALUES (?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        // Check if the statement was prepared successfully
        if ($stmt) {
            // Bind parameters and execute the query
            $stmt->bind_param("ssdi", $name, $description, $price, $stock);

            if ($stmt->execute()) {
                // Redirect back to the products page with a success message
                header('Location: admin_products.php');
                exit();
            } else {
                // Log or display the execution error
                $errors[] = "Error inserting product: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // Log or display the prepare error
            $errors[] = "Database error: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Add Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    </style>
</head>

<body class="bg-gray-100 flex">
    <div class="flex w-full min-h-screen">
        <?php include 'admin_sidebar.php'; ?>

        <main class="main-content flex-grow p-8 overflow-y-auto">
            <header class="header flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold">Add New Product</h1>
                <div class="user-info flex items-center font-medium">
                    <span class="mr-4 text-gray-700">Welcome,
                        <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong></span>
                    <a href="logout.php"
                        class="text-red-500 no-underline font-semibold hover:text-red-600 transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout</a>
                </div>
            </header>

            <div class="bg-white rounded-xl shadow p-6 max-w-2xl mx-auto">
                <!-- Display validation errors if any -->
                <?php if (!empty($errors)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul class="list-disc list-inside">
                        <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form action="add_product.php" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required></textarea>
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                        <input type="number" name="price" id="price" step="0.01"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                        <input type="number" name="stock" id="stock"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <a href="admin_products.php"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Add Product
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>


</html>
