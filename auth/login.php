<?php
require_once("../inc/session.php");
require_once("../inc/db.php");
require_once("../inc/function.php");

if (isset($_SESSION["userid"])) {
    Redirect_to("../views/index.php");
}
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST['password'];

    if (empty($email) || empty($password))
    {
        $_SESSION["ErrorMessage"] = "Please enter email and password.";
        Redirect_to("login.php");
    } else {
        $data = Login_Attempt($email, $password);
        if ($data) {
            $_SESSION["userid"] = $data["id"];
            $_SESSION["email"] = $data["email"];
            $_SESSION["first_name"] = $data['first_name'];
            $_SESSION["middle_name"] = $data['middle_name'];
            $_SESSION["last_name"] = $data['last_name']; 
            $_SESSION["station"] = $data["station"];
            $_SESSION["phone"] = $data["phone"];
            $_SESSION["datetime"] = $data["datetime"];
            $_SESSION["role"] = $data["role"];
            $_SESSION["station_id"] = $data["station_id"];
            $_SESSION["SuccessMessage"] = "Welcome " . $_SESSION["email"] . "!";
            if ($data["first_login"] == 1) {
                Redirect_to("../new_login.php");
            } else {
                try {
                    $sqlUpdateStatus = "UPDATE users SET is_online = 1 WHERE id = :user_id";
                    $stmt = $conn->prepare($sqlUpdateStatus);
                    $stmt->execute(['user_id' => $_SESSION["userid"]]);
                } catch (PDOException $e) {
                    $_SESSION["ErrorMessage"] = "Failed to update online status: " . htmlspecialchars($e->getMessage());
                    Redirect_to("../login.php");
                }

                if (isset($_SESSION["TrackingURL"])) {
                    Redirect_to($_SESSION["TrackingURL"]);
                } else {
                    Redirect_to("../index.php");
                }
            }
        } else {
            $_SESSION["ErrorMessage"] = "Incorrect email/password.";
            Redirect_to("../login.php");
        }
    }
}
?>