<?php
session_start();

// Ensure only authenticated admins can access this page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Authentication required.']);
    exit();
}

// Ensure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit();
}

// Set content type to JSON
header('Content-Type: application/json');

// Database connection
$conn = new mysqli("localhost", "root", "", "seavlinh_shop");
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

// Sanitize and validate input
$order_id = $_POST['order_id'] ?? null;
$new_status = $_POST['new_status'] ?? null;

if (empty($order_id) || empty($new_status) || !is_numeric($order_id)) {
    echo json_encode(['success' => false, 'message' => 'Invalid order ID or status provided.']);
    exit();
}

$valid_statuses = ['Pending', 'Transporting', 'Complete'];
if (!in_array($new_status, $valid_statuses)) {
    echo json_encode(['success' => false, 'message' => 'Invalid status value.']);
    exit();
}

// Use a prepared statement to securely update the status
$sql = "UPDATE orders SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'SQL prepare failed: ' . $conn->error]);
    $conn->close();
    exit();
}

$stmt->bind_param("si", $new_status, $order_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No changes made. Order not found or status is already the same.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update order: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>