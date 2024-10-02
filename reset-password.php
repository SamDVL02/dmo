<?php
require_once("inc/session.php");
require_once("inc/db.php");
require_once("inc/function.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify the token and check expiration
    $stmt = $conn->prepare("SELECT email, reset_password_experes_at FROM users WHERE reset_password_token = :token");
    $stmt->execute(['token' => $token]);
    $user = $stmt->fetch();

    if (!$user || strtotime($user['reset_password_experes_at']) < time()) {
        $_SESSION["ErrorMessage"] = "Invalid or expired token.";
        header("Location: login.php");
        exit;
    }

    if (isset($_POST["submit"])) {
        $newPassword = $_POST["new_password"];
        $confirmPassword = $_POST["confirm_password"];

        if (empty($newPassword) || empty($confirmPassword)) {
            $_SESSION["ErrorMessage"] = "Please enter both password fields.";
        } elseif ($newPassword !== $confirmPassword) {
            $_SESSION["ErrorMessage"] = "Passwords do not match.";
        } else {
            // Update the password in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password_hash = :password_hash, reset_password_token = NULL, reset_password_experes_at = NULL WHERE email = :email");
            $stmt->execute(['password_hash' => $hashedPassword, 'email' => $user['email']]);

            $_SESSION["SuccessMessage"] = "Your password has been reset successfully!";
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
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
            display: block; /* Center the input fields */
            width: 80%; /* Adjust width */
            padding: 10px;
            margin: 10px auto; /* Center horizontally */
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
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?token=' . $token); ?>" method="POST">
        <img src="img/logo.jpg" alt="Logo" class="logo">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit" name="submit">Reset Password</button>
    </form>
    <div class="message">
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
    </div>
</body>
</html>


