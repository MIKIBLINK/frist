<?php
session_start();
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';


    $valid_username = 'admin';
    $valid_password = 'admin123';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: admin.php');
        exit();
    } else {
        $error_message = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            background-image: url('https://media.istockphoto.com/id/1211547141/photo/modern-restaurant-interior-design.jpg?s=2048x2048&w=is&k=20&c=xGXrfQfTzZ5Nqq0UH9iM3rLrHTLWuQrcFSuHDphXvwU=');
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .login-container {
            background-attachment: fixed;
            background: linear-gradient(to right, #9e57009a, #ffda4491);
            box-sizing: border-box;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            background-blend-mode: overlay;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            color: #fffcfaff;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #fff;
            font-size: 1.1em;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 12px 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1em;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #a15600dc;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #a1610096;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #a16100ff;
        }

        .error-message {
            color: #dc3545;
            margin-top: 15px;
            font-size: 0.95em;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Seavlinh-Store-Admin Login</h1>
        <?php if ($error_message): ?>
            <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <form action="admin_login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>