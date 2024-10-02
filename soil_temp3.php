<?php
include  'inc/session.php';



?>
<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/account-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:34:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DIGITAL METEOROLOGICAL OBSERVATORY</title>
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
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php include 'inc/navbar.php'  ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php include  'inc/sidebar.php'?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Please fill in initial information as required</h3>
                    <!-- <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>Setting</li>
                    </ul> -->
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Account Settings Area Start Here -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">

                                    </div>
                                </div>


                                <form class="new-added-form" method="POST" action="inc/soilbackend3.php">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Longitude</label>
                                            <input type="number" placeholder="" name="long" id="long"
                                                class="form-control" step="any" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Latitude</label>
                                            <input type="number" placeholder="" name="lat" id="long"
                                                class="form-control" step="any" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Geolocation Latitude (with two decimal places):</label>
                                            <input type="number" placeholder="" name="long" id="long"
                                                class="form-control" step="any" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Geolocation Longitude (with two decimal places):</label>
                                            <input type="number" placeholder="" name="lat" id="long"
                                                class="form-control" step="any" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>District Name:</label>
                                            <input type="text" placeholder="" name="district" id="long"
                                                class="form-control" required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Select Date of sampling</label>
                                            <input type="text" placeholder="dd/mm/yyyy" name="YY"
                                                class="form-control air-datepicker" data-position='bottom right'
                                                required>
                                            <i class="far fa-calendar-alt"></i>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Enter Crop type:*</label>
                                            <input type="text" placeholder="" name="crop_type" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Enter Crop variety:*</label>
                                            <input type="text" placeholder="" name="crop_variety" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Enter Observer's name or Initials:*</label>
                                            <input type="text" placeholder="" name="obs_name" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" name="add"
                                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset"
                                                class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
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
            <script type="text/javascript">
            function initGeolocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(success, fail);
                } else {
                    alert("Sorry, your browser does not support geolocation services.");
                }
            }

            function success(position) {
                document.getElementById('long').value = position.coords.longitude;
                document.getElementById('lat').value = position.coords.latitude;
            }

            function fail() {
                alert("Could not obtain location.");
            }

            function showPosition() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        document.getElementById("result").innerText =
                            `Type this values in the Geolocation box below (Latitude: ${position.coords.latitude})`;
                        document.getElementById("result2").innerText =
                            `Type this values in the Geolocation box below (Longitude: ${position.coords.longitude})`;
                    });
                } else {
                    alert("Sorry, your browser does not support HTML5 geolocation.");
                }
            }
            </script>
            <script>
            const yearSelect = document.getElementById("yearSelect");

            for (let year = 2001; year <= 2100; year++) {
                let option = document.createElement("option");
                option.value = year;
                option.text = year;
                yearSelect.appendChild(option);
            }
            </script>

</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/account-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:34:11 GMT -->

</html>