<?php
require_once "inc/session.php";
require_once "inc/db.php";
require_once "inc/function.php";


if (!isset($_GET['id'])) {
    $_SESSION["ErrorMessage"] = "Missing user ID";
    header("Location: all-users.php");
    exit();
    }
    $id = $_GET['id'];

    if (isset($_POST["submit"])) {
        $first_name = trim($_POST["first_name"]);
        $middle_name = trim($_POST["middle_name"]);
        $last_name = trim($_POST["last_name"]);
        $role = trim($_POST["role"]);
        $designation = trim($_POST["designation"]);
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $phone = trim($_POST["phone"]);
        $datetime = date('Y-m-d H:i:s');
        if (!$email) {
            $_SESSION["ErrorMessage"] = "Invalid email format";
            header("Location: edituser.php?id=$id");
            exit();
        }

        $sql = "UPDATE users 
                SET first_name = :first_name, middle_name = :middle_name, lat_name = :last_name, 
                    email = :email, phone = :phone, role = :role, designation = :designation, 
                    last_active_at = :last_active_at
                WHERE id = :id";


        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':first_name', $first_name);
        $stmt->bindValue(':middle_name', $middle_name);
        $stmt->bindValue(':last_name', $last_name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':role', $role);
        $stmt->bindValue(':designation', $designation);
        $stmt->bindValue(':last_active_at', $datetime);
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();
        if ($result) {
            $_SESSION["SuccessMessage"] = "User updated successfully";
            header("Location: all-users.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
            header("Location: edituser.php?id=$id");
        }
    }
?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DMO</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="fonts/flaticon.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/datepicker.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>
<body>
    <?php require_once "inc/navbar.php" ?>
    <div class="dashboard-page-one">
        <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
            <div class="mobile-sidebar-header d-md-none">
                <div class="header-logo">
                    <a href="index.php"><img src="img/logo.jpg" alt="logo"></a>
                </div>
            </div>
            <?php  include 'inc/sidebar.php' ?>
        </div>
        <div class="dashboard-content-one">
            <div class="breadcrumbs-area">
                <h3>Update Users</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                        $sql  = "SELECT * FROM users WHERE id='$id'";
                        $stmt = $conn ->query($sql);
                        while ($rows=$stmt->fetch()) {
                        $id    = $rows['id'];
                        $first_name = $rows['first_name'];
                        $middle_name   = $rows['middle_name'];
                        $last_name = $rows["lat_name"];
                        $email    = $rows['email'];
                        $phone = $rows["phone"];
                        }

                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                </div>
                            </div>
                            <form class="new-added-form" method="POST" action="edituser.php?id=<?php echo $id; ?>">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" value="<?php echo $first_name ?>"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Middle Name</label>
                                            <input type="text" name="middle_name" value="<?php echo $middle_name ?>"
                                                class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" value="<?php echo $last_name ?>"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="<?php echo $email ?>"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" value="<?php echo $phone ?>"
                                                class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Designation</label>
                                            <select name="designation" class="form-control">
                                                <option value=""></option>
                                                <option value="met assistant">Met Assistant</option>
                                                <option value="meterologist">Meterologist</option>
                                                <option value="incharge">incharge</option>
                                                <option value="manager">Manager</option>
                                                <option value="dg">DG</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Role</label>
                                            <select name="role" class="form-control" required>
                                                <option value=""></option>
                                                <option value="admin">Admin</option>
                                                <option value="super-user">Super User</option>
                                                <option value="user">User</option>
                                                <option value="mcc">MCC</option>
                                                <option value="mcto">MCTO</option>
                                                <option value="dg">DG</option>
                                                <option value="cfo">CFO</option>
                                                <option value="data">DATA</option>
                                                <option value="dra">DRA</option>
                                            </select>
                                        </div>

                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" name="submit"
                                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                                            <button type="reset"
                                                class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>