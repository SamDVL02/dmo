<?php
require_once("inc/session.php");
require_once("inc/db.php");
require_once("inc/function.php");
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



if (isset($_POST["submit"])) {
    $email = $_POST["email"];

    if (empty($email)) {
        $_SESSION["ErrorMessage"] = "Please enter your email.";
    } else {
        // Check if email exists in database
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            $token = bin2hex(random_bytes(50)); // Generate a unique token
            $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour')); // Set expiration time
            $stmt = $conn->prepare("UPDATE users SET reset_password_token = :token, reset_password_experes_at = :expires WHERE email = :email");
            $stmt->execute(['token' => $token, 'expires' => $expiresAt, 'email' => $email]);

            // Send email with reset link using PHPMailer
            $resetLink = "http://localhost/meshack2/reset-password.php?token=" . $token;

            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();                                           // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                // Enable SMTP authentication
                $mail->Username   = 'massamugeorge@gmail.com';              // Your Gmail address
                $mail->Password   = 'fudf nvcl ovsr qhpa';               // Your Gmail password (or App Password)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // Enable TLS encryption
                $mail->Port       = 587;                                 // TCP port to connect to

                //Recipients
                $mail->setFrom('massamugerge@gmail.com', 'George Massamu');     // Your name and email
                $mail->addAddress($email);                               // Add a recipient (user's email)

                // Content
                $mail->isHTML(true);                                    // Set email format to HTML
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = "Click this link to reset your password: <a href='$resetLink'>$resetLink</a>";

                $mail->send();
                $_SESSION["SuccessMessage"] = "A password reset link has been sent to your email.";
            } catch (Exception $e) {
                // $_SESSION["ErrorMessage"] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                $_SESSION["ErrorMessage"] = "Password resent link failed";
            }
        } else {
            $_SESSION["ErrorMessage"] = "Email not found.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.5s;
            width: 300px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <img src="img/logo.jpg" alt="Logo" class="logo">
        <!-- <h2>Forgot Password</h2> -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit" name="submit">Send Reset Link</button>
        </form>
        <div class="message">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
        </div>
    </div>
</body>
</html>
