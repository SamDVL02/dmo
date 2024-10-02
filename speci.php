
<?php
include "inc/session.php";
include "inc/db.php";

$user_id = $_SESSION['userid'];

// Prepare and execute the first query to get the station_id
$sql = "SELECT station_id FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data was fetched
if ($user) {
    $station_id = $user['station_id'];

    // Prepare and execute the second query to get the station name
    $sql1 = "SELECT name FROM station WHERE id = :station_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute(['station_id' => $station_id]);
    $station = $stmt1->fetch(PDO::FETCH_ASSOC);

    // Check if station data was fetched
    if ($station) {
        $name = $station['name'];
    } else {
        $name = 'Unknown Station'; // Default value if station is not found
    }
} else {
    $name = 'Unknown Station'; // Default value if user is not found
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
    <title>DMO</title>
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
    <div id="wrapper" class="wrapper bg-ash">
        <?php include 'inc/navbar.php'  ?>
        <div class="dashboard-page-one">
            <?php include  'inc/sidebar.php'?>
            <div class="dashboard-content-one">

     <div class="breadcrumbs-area">
    <h3> <?php echo $name ?> Station</h3>
    </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3> SPECI Report Generation</h3>
                                    </div>
                                </div>

                                <form class="new-added-form" method="POST" action="inc/spcibackend.php">
    <div class="row">

        <!-- Observation Details -->
        <div class="col-12 form-group">
            <h4><b>Observation Details</b></h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="time-of-observation">Time of Observation (UTC)</label>
            <select class="select2" id="time-of-observation" name="t_o_o" required>
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
            <input type="text" id="trend" name="trend" class="form-control" required>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="remarks">Remarks</label>
            <input type="text" id="remarks" name="remarks" class="form-control" required>
        </div>

        <!-- Wind Information -->
        <div class="col-12 form-group">
            <h4><b>Wind Information</b></h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="wind-direction">Wind Direction</label>
            <input type="number" id="wind-direction" name="w_d" class="form-control" step="any">
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="wind-speed">Wind Speed (KT)</label>
            <input type="number" id="wind-speed" name="w_s" class="form-control" step="any">
        </div>

        <!-- Visibility and Weather -->
        <div class="col-12 form-group">
            <h4><b>Visibility and Weather</b></h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="visibility">Visibility</label>
            <input type="number" id="visibility" name="visib" class="form-control" step="any">
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="present-weather">Present Weather</label>
            <input type="number" id="present-weather" name="p_w" class="form-control" step="any">
        </div>

        <!-- Cloud Information -->
        <div class="col-12 form-group">
            <h4><b>Cloud Information</b></h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="sky-cloud-cover">Total Sky Cloud Cover (Oktas)</label>
            <input type="number" id="sky-cloud-cover" name="tscc" class="form-control" step="any">
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="sco1">1st Significant Cloud (Oktas)</label>
            <select class="select2" id="sco1" name="sco1">
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
            <input type="number" id="sch1" name="sch1" class="form-control" step="any">
        </div>
        
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="sco2">2nd Significant Cloud (Oktas)</label>
            <select class="select2" id="sco2" name="sco2">
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
            <input type="number" id="sch2" name="sch2" class="form-control" step="any">
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="iclt2">2nd Individual Cloud Layer Type</label>
            <select class="select2" id="iclt2" name="iclt2">
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
            <select class="select2" id="sco3" name="sco3">
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
            <input type="number" id="sch3" name="sch3" class="form-control" step="any">
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="sco4">4th Significant Cloud (Oktas)</label>
            <select class="select2" id="sco4" name="sco4">
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
            <input type="number" id="sch4" name="sch4" class="form-control" step="any">
        </div>

        <!-- Temperature and Pressure -->
        <div class="col-12 form-group">
            <h4><b>Temperature and Pressure</b></h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="dry-bulb-temperature">Dry Bulb Temperature</label>
            <input type="number" id="dry-bulb-temperature" name="d_b_t" class="form-control" step="any" required>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="dew-point-temperature">Dew Point Temperature</label>
            <input type="number" id="dew-point-temperature" name="d_p_t" class="form-control" step="any" required>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="qnh-h">QNH (hpa)</label>
            <input type="number" id="qnh-h" name="qnh_h" class="form-control" step="any" required>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="qnh-w">QNH (Whole)</label>
            <input type="number" id="qnh-w" name="qnh_w" class="form-control" step="any" required>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="clp">C.L.P (hpa)</label>
            <input type="number" id="clp" name="c_l_p" class="form-control" step="any" required>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="wet-bulb-temperature">Wet Bulb Temperature</label>
            <input type="number" id="wet-bulb-temperature" name="w_b_t" class="form-control" step="any" required>
        </div>

        <!-- Buttons -->
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
            </div>
            <script src="js/jquery-3.3.1.min.js"></script>
            <script src="js/plugins.js"></script>
            <script src="js/popper.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.scrollUp.min.js"></script>
            <script src="js/select2.min.js"></script>
            <script src="js/datepicker.min.js"></script>
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