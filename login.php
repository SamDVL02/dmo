<?php
require_once("inc/session.php");
require_once("inc/db.php");
require_once("inc/function.php");

if (isset($_SESSION["userid"])) {
    Redirect_to("../views/index.php");
}

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION["ErrorMessage"] = "Please enter email and password.";
        Redirect_to("login.php");
    } else {
        $data = Login_Attempt($email, $password);
        if ($data) {
            $_SESSION["userid"] = $data["id"];
            $_SESSION["email"] = $data["email"];
            $_SESSION["first_name"] = $data['first_name'];
            $_SESSION["middle_name"] = $data['middle_name'];
            $_SESSION["last_name"] = $data['last_name']; // Corrected typo from 'lat_name' to 'last_name'
            $_SESSION["station"] = $data["station"];
            $_SESSION["phone"] = $data["phone"];
            $_SESSION["datetime"] = $data["datetime"];
            $_SESSION["role"] = $data["role"];
            $_SESSION["station_id"] = $data["station_id"];
            $_SESSION["SuccessMessage"] = "Welcome " . $_SESSION["email"] . "!";

            // Check if the user is logging in for the first time
            if ($data["first_login"] == 1) {
                // Redirect to password reset form
                Redirect_to("new_login.php");
            } else {
                // Update the is_online field to 1
                try {
                    $sqlUpdateStatus = "UPDATE users SET is_online = 1 WHERE id = :user_id";
                    $stmt = $conn->prepare($sqlUpdateStatus);
                    $stmt->execute(['user_id' => $_SESSION["userid"]]);
                } catch (PDOException $e) {
                    $_SESSION["ErrorMessage"] = "Failed to update online status: " . htmlspecialchars($e->getMessage());
                    Redirect_to("login.php");
                }

                if (isset($_SESSION["TrackingURL"])) {
                    Redirect_to($_SESSION["TrackingURL"]);
                } else {
                    Redirect_to("index.php");
                }
            }
        } else {
            $_SESSION["ErrorMessage"] = "Incorrect email/password.";
            Redirect_to("login.php");
        }
    }
}
?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="fonts/flaticon.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Modernize js -->
    <script src="js/modernizr-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="dashboard-content-one">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1"></div>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                    class="new-added-form">
                    <div class="row">
                        <div class="col-12">
                            <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                        ?>
                            <img src="img/logo.jpg" alt="Logo">

                            <div class="form-group">
                                <!-- <label for="email">Email</label> -->
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
                            </div>

                            <div class="form-group">
                                <!-- <label for="password">Password</label> -->
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            </div>

                            <div class="form-group mg-t-8">
                                <button type="submit" name="submit"
                                    class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Login</button>
                            </div>
                            <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jquery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>

</html>
