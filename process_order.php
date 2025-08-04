<?php
include 'db.php';

$action = $_POST['action'] ?? null; // For lookup
$data = json_decode(file_get_contents('php://input'), true); // For place_order

if ($data && isset($data['action'])) {
    $action = $data['action'];
}


switch ($action) {
    case 'lookup_user':
        $phoneNumber = $_POST['phone_number'] ?? '';
        if (empty($phoneNumber)) {
            echo json_encode(['success' => false, 'message' => 'Phone number is required for lookup.']);
            exit();
        }

        $stmt = $conn->prepare("SELECT id, name, address FROM users WHERE phone_number = ?");
        $stmt->bind_param("s", $phoneNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found.']);
        }
        $stmt->close();
        break;

    case 'place_order':
        if (!isset($data['order_data'])) {
            echo json_encode(['success' => false, 'message' => 'No order data received.']);
            exit();
        }
        $orderData = $data['order_data'];

        $phoneNumber = $orderData['phone_number'] ?? '';
        $name = $orderData['name'] ?? '';
        $address = $orderData['address'] ?? '';
        $paymentMethod = $orderData['payment_method'] ?? '';
        $cartItems = json_encode($orderData['cart_items']) ?? '[]'; // Store cart items as JSON
        $totalAmount = $orderData['total_amount'] ?? 0.00;

        if (empty($phoneNumber) || empty($name) || empty($address) || empty($paymentMethod) || empty($orderData['cart_items'])) {
            echo json_encode(['success' => false, 'message' => 'Missing required order information.']);
            exit();
        }

        $userId = null;

        // Check if user exists by phone number
        $stmt = $conn->prepare("SELECT id FROM users WHERE phone_number = ?");
        $stmt->bind_param("s", $phoneNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, update their name and address
            $user = $result->fetch_assoc();
            $userId = $user['id'];
            $updateStmt = $conn->prepare("UPDATE users SET name = ?, address = ? WHERE id = ?");
            $updateStmt->bind_param("ssi", $name, $address, $userId);
            $updateStmt->execute();
            $updateStmt->close();
        } else {
            // New user, insert into users table
            $insertStmt = $conn->prepare("INSERT INTO users (phone_number, name, address) VALUES (?, ?, ?)");
            $insertStmt->bind_param("sss", $phoneNumber, $name, $address);
            if ($insertStmt->execute()) {
                $userId = $conn->insert_id; // Get the ID of the newly inserted user
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to register user: ' . $insertStmt->error]);
                $insertStmt->close();
                $conn->close();
                exit();
            }
            $insertStmt->close();
        }
        $stmt->close();

        if ($userId) {
            // Insert order into orders table
            $orderStmt = $conn->prepare("INSERT INTO orders (user_id, order_details, total_amount, payment_method) VALUES (?, ?, ?, ?)");
            $orderStmt->bind_param("isds", $userId, $cartItems, $totalAmount, $paymentMethod);

            if ($orderStmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Order placed successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to place order: ' . $orderStmt->error]);
            }
            $orderStmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'User ID not found or created.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
        break;
}

$conn->close();
?>