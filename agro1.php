<?php
include  'inc/session.php';



?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DIGITAL METEOROLOGICAL OBSERVATORY</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="fonts/flaticon.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/datepicker.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>

<body>

    <div id="preloader"></div>
    <div id="wrapper" class="wrapper bg-ash">

       <?php include 'inc/navbar.php'  ?>

        <div class="dashboard-page-one">
           <?php include  'inc/sidebar.php'?>
            <div class="dashboard-content-one">

                <div class="breadcrumbs-area">
                    <h3>Agrometeorological Daily Weather Parameter Report (AGRO-MET)</h3>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        
                                    </div>
                                    <div class="dropdown">
                   
                                    </div>
                                </div>

                                <form class="new-added-form" method="POST"  action="inc/agrobackend1.php">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Select Crop Type:</label>
                                            <select class="select2" name="crop_type">
                                                <option value="">Please Select Crop Type</option>
                                                <option value="Annual">Annual</option>
                                                <option value="Annual">Annual</option>
                                                <option value="Annual">Annual</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Field Number</label>
                                            <input type="text" placeholder="" name="field_number" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Crop</label>
                                            <input type="text" placeholder="" name="crop" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Variety</label>
                                            <input type="text" placeholder="" name="variety" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Observation Date</label>
                                            <input type="text" placeholder="dd/mm/yyyy" name="YY" class="form-control air-datepicker"
                                                data-position='bottom right'>
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Enter Phenological Phase</label>
                                            <input type="number" placeholder="" name="pheno_phase" class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Enter Length</label>
                                            <input type="number" placeholder="" name="length" class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Enter width</label>
                                            <input type="number" placeholder="" name="width" class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Enter Height</label>
                                            <input type="number" placeholder="" name="height" class="form-control" step="any">
                                        </div>
                                
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Enter Leaf Area</label>
                                            <input type="text" placeholder="" name="P_in"  class="form-control">
                                        </div>                               
                            
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" name="add" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
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
                navigator.geolocation.getCurrentPosition(function (position) {
                    document.getElementById("result").innerText = `Type this values in the Geolocation box below (Latitude: ${position.coords.latitude})`;
                    document.getElementById("result2").innerText = `Type this values in the Geolocation box below (Longitude: ${position.coords.longitude})`;
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