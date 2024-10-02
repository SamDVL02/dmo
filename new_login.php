<?php
require_once("inc/session.php");
require_once("inc/db.php");
require_once("inc/function.php");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_id = $_SESSION['userid']; // Assuming the user ID is stored in session

    // Validate new password
    if ($new_password !== $confirm_password) {
        $_SESSION["ErrorMessage"] = "Passwords do not match.";
        Redirect_to("new_login.php");
        exit;
    }

    // Check password strength
    if (strlen($new_password) < 6 || !preg_match('/[A-Za-z]/', $new_password) || !preg_match('/[0-9]/', $new_password)) {
        $_SESSION["ErrorMessage"] = "Password must be at least 6 characters long and include both letters and numbers.";
        Redirect_to("new_login.php");
        exit;
    }

    // Hash the new password
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user's password and set first_login to 0
    $stmt = $conn->prepare("UPDATE users SET password_hash = :password_hash, first_login = 0 WHERE id = :id");
    $result = $stmt->execute(['password_hash' => $new_password_hash, 'id' => $user_id]);

    if ($result) {
        $_SESSION["SuccessMessage"] = "Password updated successfully!";
        Redirect_to("index.php"); // Redirect to dashboard or login page
    } else {
        $_SESSION["ErrorMessage"] = "Failed to update password. Please try again.";
        Redirect_to("new_login.php");
    }
}

// Fetch the user's name for display (assuming it's stored in the session)
$user_full_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] . ' ' . (isset($_SESSION['middle_name']) ? $_SESSION['middle_name'] . ' ' : '') . $_SESSION['last_name'] : 'User';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        input[type="password"] {
            display: block; 
            width: 80%; 
            padding: 10px;
            margin: 10px auto; 
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-top: 10px;
        }
        .user-name {
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="user-name">Hello, <?php echo htmlspecialchars($user_full_name); ?>!</div>
        <img src="img/logo.jpg" alt="Logo" class="logo">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit" name="submit">Change Password</button>
    </form>
    <div class="message">
        <?php
        echo ErrorMessage(); // Show error message if set
        echo SuccessMessage(); // Show success message if set
        ?>
    </div>
</body>
</html>
