<?php require_once "inc/session.php" ?>
<?php require_once "inc/db.php" ?>
<?php require_once "inc/function.php" ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<?php
$id =$_GET['id'];

if(isset($_POST["submit"])){
$name = $_POST["name"];
$sql = "UPDATE countries
SET name ='$name'
WHERE id=$id ";

$results= $conn->query($sql);

if ($results) {
$_SESSION["SuccessMessage"]=" Country Updated ";
Redirect_to("viewCountry.php");
// code...
}else {
$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
Redirect_to("viewCountry.php");
}

}

?>


<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/account-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:34:02 GMT -->

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="fonts/flaticon.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="css/select2.min.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="css/datepicker.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Modernize js -->
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>

<body>


    <?php require_once "inc/navbar.php" ?>
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
            <div class="mobile-sidebar-header d-md-none">
                <div class="header-logo">
                    <a href="index.php"><img src="img/logo.jpg" alt="logo"></a>
                </div>
            </div>

            <?php  include 'inc/sidebar.php' ?>


        </div>

        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">
                <h3>Update Country</h3>
                <!-- <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>Country Update</li>
                </ul> -->
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Account Settings Area Start Here -->
            <div class="row">
                <div class="col-12">
                    <?php
echo ErrorMessage();
// echo SuccessMessage();


$sql  = "SELECT * FROM countries WHERE id='$id'";
$stmt = $conn ->query($sql);
while ($rows=$stmt->fetch()) {
$id    = $rows['id'];
$name = $rows['name'];
}
?>


                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                </div>


                            </div>
                            <form class="" action="editCountry.php?id=<?php echo $id; ?>" method="post"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Name</label>
                                            <input type="text" placeholder="" name="name"
                                                value="<?php echo $name ?>" class="form-control" required>
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
            <!-- Account Settings Area End Here -->

        </div>
    </div>
    <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Select 2 Js -->
    <script src="js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="js/datepicker.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/account-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:34:11 GMT -->

</html>