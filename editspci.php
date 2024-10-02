<?php require_once "inc/session.php"; ?>
<?php require_once "inc/db.php"; ?>
<?php require_once "inc/function.php"; ?>
<?php 
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login(); 
$id = $_GET['id'];


if (isset($_POST["submit"])) {
    $time_of_observation = $_POST['t_o_o'];
    $wind_direction = $_POST['w_d'];
    $wind_speed = $_POST['w_s'];
    $visibility = $_POST['visib'];
    $present_weather = $_POST['p_w'];
    $total_sky_cloud_cover = $_POST['tscc'];
    $first_significant_cloud_oktas = $_POST['sco1'];
    $first_significant_cloud_height = $_POST['sch1'];
    $second_significant_cloud_height = $_POST['sch2'];
    $second_individual_cloud_layer_type = $_POST['iclt2'];
    $third_significant_cloud_oktas = $_POST['sco3'];
    $third_significant_cloud_height = $_POST['sch3'];
    $fourth_significant_cloud_oktas = $_POST['sco4'];
    $fourth_significant_cloud_height = $_POST['sch4'];
    $dry_bulb_temperature = $_POST['d_b_t'];
    $dew_point_temperature = $_POST['d_p_t'];
    $qnh_h = $_POST['qnh_h'];
    $qnh_w = $_POST['qnh_w'];
    $clp_h = $_POST['c_l_p'];
    $wet_bulb_temperature = $_POST['w_b_t'];
    $trend = $_POST['trend'];
    $remarks = $_POST['remarks'];
    $user_id = $_SESSION['userid'];

    $sql = "UPDATE speci SET 
        time_of_observation = :time_of_observation, 
        wind_direction = :wind_direction, 
        wind_speed = :wind_speed, 
        visibility = :visibility, 
        present_weather = :present_weather, 
        total_sky_cloud_cover = :total_sky_cloud_cover, 
        first_significant_cloud_oktas = :first_significant_cloud_oktas, 
        first_significant_cloud_height = :first_significant_cloud_height, 
        second_significant_cloud_height = :second_significant_cloud_height, 
        second_individual_cloud_layer_type = :second_individual_cloud_layer_type, 
        third_significant_cloud_oktas = :third_significant_cloud_oktas, 
        third_significant_cloud_height = :third_significant_cloud_height, 
        fourth_significant_cloud_oktas = :fourth_significant_cloud_oktas, 
        fourth_significant_cloud_height = :fourth_significant_cloud_height, 
        dry_bulb_temperature = :dry_bulb_temperature, 
        dew_point_temperature = :dew_point_temperature, 
        qnh_h = :qnh_h, 
        qnh_w = :qnh_w, 
        clp = :clp,  
        wet_bulb_temperature = :wet_bulb_temperature, 
        trend = :trend, 
        remarks = :remarks 
        WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':time_of_observation', $time_of_observation);
    $stmt->bindParam(':wind_direction', $wind_direction);
    $stmt->bindParam(':wind_speed', $wind_speed);
    $stmt->bindParam(':visibility', $visibility);
    $stmt->bindParam(':present_weather', $present_weather);
    $stmt->bindParam(':total_sky_cloud_cover', $total_sky_cloud_cover);
    $stmt->bindParam(':first_significant_cloud_oktas', $first_significant_cloud_oktas);
    $stmt->bindParam(':first_significant_cloud_height', $first_significant_cloud_height);
    $stmt->bindParam(':second_significant_cloud_height', $second_significant_cloud_height);
    $stmt->bindParam(':second_individual_cloud_layer_type', $second_individual_cloud_layer_type);
    $stmt->bindParam(':third_significant_cloud_oktas', $third_significant_cloud_oktas);
    $stmt->bindParam(':third_significant_cloud_height', $third_significant_cloud_height);
    $stmt->bindParam(':fourth_significant_cloud_oktas', $fourth_significant_cloud_oktas);
    $stmt->bindParam(':fourth_significant_cloud_height', $fourth_significant_cloud_height);
    $stmt->bindParam(':dry_bulb_temperature', $dry_bulb_temperature);
    $stmt->bindParam(':dew_point_temperature', $dew_point_temperature);
    $stmt->bindParam(':qnh_h', $qnh_h);
    $stmt->bindParam(':qnh_w', $qnh_w);
    $stmt->bindParam(':clp', $clp);
    $stmt->bindParam(':wet_bulb_temperature', $wet_bulb_temperature);
    $stmt->bindParam(':trend', $trend);
    $stmt->bindParam(':remarks', $remarks);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $result = $stmt->execute();
    if ($result) {
        $_SESSION["SuccessMessage"] = "Metar Data updated successfully";
        header("Location: all-speci.php");
        exit();
    } else {
        $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
        header("Location: all-speci.php?id=$id");
        exit();
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
    <div id="preloader"></div>
    <div id="wrapper" class="wrapper bg-ash">
        <?php include 'inc/navbar.php'  ?>
        <div class="dashboard-page-one">
            <?php include  'inc/sidebar.php'?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                    <h3>Edit Speci Report</h3>
                </div>
                <?php
                            $sql  = "SELECT * FROM speci WHERE id='$id'";
                            $stmt = $conn ->query($sql);
                            while ($rows=$stmt->fetch()) {
                            $id    = $rows['id'];
                            $t_o = $rows['time_of_observation'];
                            $w_d   = $rows['wind_direction'];
                            $w_s = $rows["wind_speed"];
                            $visibility   = $rows['visibility'];
                            $present_weather = $rows["present_weather"];
                            $total_sky_c_c   = $rows['total_sky_cloud_cover'];
                            $first_s_c_o   = $rows['first_significant_cloud_oktas'];
                            $first_significant_cloud_height   = $rows['first_significant_cloud_height'];
                            $second_significant_cloud_oktas   = $rows['second_significant_cloud_oktas'];
                            $second_significant_cloud_height   = $rows['second_significant_cloud_height'];
                            $second_individual_cloud_layer_type   = $rows['second_individual_cloud_layer_type'];
                            $third_significant_cloud_oktas   = $rows['third_significant_cloud_oktas'];
                            $third_significant_cloud_height   = $rows['third_significant_cloud_height'];
                            $fourth_significant_cloud_oktas   = $rows['fourth_significant_cloud_oktas'];
                            $fourth_significant_cloud_height  = $rows['fourth_significant_cloud_height'];
                            $dry_bulb_temperature   = $rows['dry_bulb_temperature'];
                            $dew_point_temperature   = $rows['dew_point_temperature'];
                            $qnh_h   = $rows['qnh_h'];
                            $qnh_w  = $rows['qnh_w'];
                            $clp  = $rows['clp'];
                            $wet_bulb_temperature  = $rows['wet_bulb_temperature'];
                            $trend  = $rows['trend'];
                            $remarks  = $rows['remarks'];
                      }

                ?>
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

                                <form class="new-added-form" method="POST" action="editspci.php?id=<?php echo $id; ?>">
                                    <div class="row">

                                        <div class="col-12 form-group">
                                            <h4><b>Observation Details</b></h4>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="time-of-observation">Time of Observation (UTC)</label>
                                            <select class="select2" id="time-of-observation" name="t_o_o"
                                                value="<?php echo $t_o ?>" required>
                                                <option value="" disabled selected>Select time</option>
                                                <!-- Time options -->
                                                <option value="0000">0000</option>
                                                <option value="0030">0030</option>
                                                <option value="0100">0100</option>
                                                <option value="0130">0130</option>
                                                <option value="0200">0200</option>
                                                <option value="0230">0230</option>
                                                <option value="0300">0300</option>
                                                <option value="0330">0330</option>
                                                <option value="0400">0400</option>
                                                <option value="0430">0430</option>
                                                <option value="0500">0500</option>
                                                <option value="0530">0530</option>
                                                <option value="0600">0600</option>
                                                <option value="0630">0630</option>
                                                <option value="0700">0700</option>
                                                <option value="0730">0730</option>
                                                <option value="0800">0800</option>
                                                <option value="0830">0830</option>
                                                <option value="0900">0900</option>
                                                <option value="0930">0930</option>
                                                <option value="1000">1000</option>
                                                <option value="1030">1030</option>
                                                <option value="1100">1100</option>
                                                <option value="1130">1130</option>
                                                <option value="1200">1200</option>
                                                <option value="1230">1230</option>
                                                <option value="1300">1300</option>
                                                <option value="1330">1330</option>
                                                <option value="1400">1400</option>
                                                <option value="1430">1430</option>
                                                <option value="1500">1500</option>
                                                <option value="1530">1530</option>
                                                <option value="1600">1600</option>
                                                <option value="1630">1630</option>
                                                <option value="1700">1700</option>
                                                <option value="1730">1730</option>
                                                <option value="1800">1800</option>
                                                <option value="1830">1830</option>
                                                <option value="1900">1900</option>
                                                <option value="1930">1930</option>
                                                <option value="2000">2000</option>
                                                <option value="2030">2030</option>
                                                <option value="2100">2100</option>
                                                <option value="2130">2130</option>
                                                <option value="2200">2200</option>
                                                <option value="2230">2230</option>
                                                <option value="2300">2300</option>
                                                <option value="2330">2330</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="trend">Trend</label>
                                            <input type="text" id="trend" name="trend" class="form-control"
                                                value="<?php echo $trend ?>">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" id="remarks" name="remarks" class="form-control"
                                                value="<?php echo $remarks ?>">
                                        </div>

                                        <!-- Wind Information -->
                                        <div class="col-12 form-group">
                                            <h4><b>Wind Information</b></h4>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind-direction">Wind Direction</label>
                                            <input type="number" id="wind-direction" name="w_d" class="form-control"
                                                value="<?php echo $w_d  ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind-speed">Wind Speed (KT)</label>
                                            <input type="number" id="wind-speed" name="w_s" class="form-control"
                                                value="<?php echo $w_s ?>" step="any">
                                        </div>

                                        <!-- Visibility and Weather -->
                                        <div class="col-12 form-group">
                                            <h4><b>Visibility and Weather</b></h4>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="visibility">Visibility</label>
                                            <input type="number" id="visibility" name="visib" class="form-control"
                                                value="<?php echo $visibility  ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="present-weather">Present Weather</label>
                                            <input type="number" id="present-weather" name="p_w" class="form-control"
                                                value="<?php echo $present_weather ?>" step="any">
                                        </div>

                                        <!-- Cloud Information -->
                                        <div class="col-12 form-group">
                                            <h4><b>Cloud Information</b></h4>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="sky-cloud-cover">Total Sky Cloud Cover (Oktas)</label>
                                            <input type="number" id="sky-cloud-cover" name="tscc" class="form-control"
                                                value="<?php echo $total_sky_c_c  ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="sco1">1st Significant Cloud (Oktas)</label>
                                            <select class="select2" id="sco1" name="sco1"
                                                value="<?php echo $first_s_c_o  ?>">
                                                <option value="" disabled selected>Select oktas</option>
                                                <option value="8">8</option>
                                                <option value="7">7</option>
                                                <option value="6">6</option>
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind-speed">1st Significant Cloud (Height ft)</label>
                                            <input type="number" id="sch1" name="sch1" class="form-control"
                                                value="<?php echo $first_significant_cloud_height ?>" step="any">
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="sco2">2nd Significant Cloud (Oktas)</label>
                                            <select class="select2" id="sco2" name="sco2"
                                                value="<?php echo $second_significant_cloud_oktas  ?>">
                                                <option value="" disabled selected>Select oktas</option>
                                                <option value="8">8</option>
                                                <option value="7">7</option>
                                                <option value="6">6</option>
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind-speed">2nd Significant Cloud (Height ft)</label>
                                            <input type="number" id="sch2" name="sch2" class="form-control"
                                                value="<?php echo $second_significant_cloud_height  ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="iclt2">2nd Individual Cloud Layer Type</label>
                                            <select class="select2" id="iclt2" name="iclt2"
                                                value="<?php echo $second_individual_cloud_layer_type  ?>">
                                                <option value="" disabled selected>Select type</option>
                                                <option value="8">8</option>
                                                <option value="7">7</option>
                                                <option value="6">6</option>
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="sco3">3rd Significant Cloud (Oktas)</label>
                                            <select class="select2" id="sco3" name="sco3"
                                                value="<?php echo $third_significant_cloud_oktas  ?>">
                                                <option value="" disabled selected>Select oktas</option>
                                                <option value="8">8</option>
                                                <option value="7">7</option>
                                                <option value="6">6</option>
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind-speed">3rd Significant Cloud (Height ft)</label>
                                            <input type="number" id="sch3" name="sch3" class="form-control"
                                                value="<?php echo $third_significant_cloud_height ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="sco4">4th Significant Cloud (Oktas)</label>
                                            <select class="select2" id="sco4" name="sco4"
                                                value="<?php echo $fourth_significant_cloud_oktas ?>">
                                                <option value="" disabled selected>Select oktas</option>
                                                <option value="8">8</option>
                                                <option value="7">7</option>
                                                <option value="6">6</option>
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind-speed">4th Significant Cloud (Height ft)</label>
                                            <input type="number" id="sch4" name="sch4" class="form-control"
                                                value="<?php echo $fourth_significant_cloud_height ?>" step="any">
                                        </div>

                                        <!-- Temperature and Pressure -->
                                        <div class="col-12 form-group">
                                            <h4><b>Temperature and Pressure</b></h4>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="dry-bulb-temperature">Dry Bulb Temperature</label>
                                            <input type="number" id="dry-bulb-temperature" name="d_b_t"
                                                class="form-control" value="<?php echo $$dry_bulb_temperature  ?>"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="dew-point-temperature">Dew Point Temperature</label>
                                            <input type="number" id="dew-point-temperature" name="d_p_t"
                                                class="form-control" value="<?php echo $dew_point_temperature ?>"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="qnh-h">QNH (hpa)</label>
                                            <input type="number" id="qnh-h" name="qnh_h" class="form-control" step="any"
                                                value="<?php echo $qnh_h ?>">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="qnh-w">QNH (Whole)</label>
                                            <input type="number" id="qnh-w" name="qnh_w" class="form-control" step="any"
                                                value="<?php echo $qnh_w ?>">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="clp">C.L.P (hpa)</label>
                                            <input type="number" id="clp" name="c_l_p" class="form-control" step="any"
                                                value="<?php echo $clp ?>">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wet-bulb-temperature">Wet Bulb Temperature</label>
                                            <input type="number" id="wet-bulb-temperature" name="w_b_t"
                                                class="form-control" value="<?php echo $wet_bulb_temperature  ?>"
                                                step="any">
                                        </div>

                                        <!-- Buttons -->
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" name="submit"
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
</body>

</html>