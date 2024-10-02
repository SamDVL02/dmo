<?php
include "inc/session.php";
include "inc/db.php";
$user_id = $_SESSION['userid'];
$sql = "SELECT station_id FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($user) {
    $station_id = $user['station_id'];
    $sql1 = "SELECT name FROM station WHERE id = :station_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute(['station_id' => $station_id]);
    $station = $stmt1->fetch(PDO::FETCH_ASSOC);
    if ($station) {
        $name = $station['name'];
    } else {
        $name = 'Unknown Station';
    }
} else {
    $name = 'Unknown Station';
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

<body onLoad="initGeolocation();">
    <div id="wrapper" class="wrapper bg-ash">
        <?php include 'inc/navbar.php'  ?>
        <div class="dashboard-page-one">
            <?php include  'inc/sidebar.php'?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                    <h3><?php echo $name ?> Station</h3>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3> METAR Report Generation</h3>
                                    </div>
                                </div>
                                <form class="new-added-form" method="POST" action="inc/metor_report.php">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="time-of-observation">Time of Observation (UTC)</label>
                                            <select class="select2" id="time-of-observation" name="time_of_observation" required>
                                                <option value="" disabled selected>Select time</option>
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
                                                <option value="0500">0500</option>
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <h5><b>Weather Conditions</b></h5>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind-direction">Wind Direction (degrees)</label>
                                            <input type="number" id="wind-direction" name="wind_direction" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind-speed">Wind Speed (KT)</label>
                                            <input type="number" id="wind-speed" name="wind_speed" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="visibility">Visibility</label>
                                            <input type="text" id="visibility" name="visibility" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="present-weather">Present Weather</label>
                                            <input type="text" id="present-weather" name="present_weather" class="form-control">
                                        </div>
                                        <div class="col-12 form-group">
                                            <h5><b>Cloud Information</b></h5>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="total-sky-cloud-cover">Total Sky Cloud Cover (Oktas)</label>
                                            <input type="number" id="total-sky-cloud-cover" name="tscc"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="first-significant-cloud-oktas">1st Significant Cloud
                                                (Oktas)</label>
                                            <select class="select2" id="first-significant-cloud-oktas" name="sco1">
                                                <option value="" disabled selected>Select Oktas</option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="first-significant-cloud-height">1st Significant Cloud (Height
                                                ft)</label>
                                            <input type="number" id="first-significant-cloud-height" name="sch1"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="second-significant-cloud-oktas">2nd Significant Cloud
                                                (Oktas)</label>
                                            <select class="select2" id="second-significant-cloud-oktas" name="sco2">
                                                <option value="" disabled selected>Select Oktas</option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="second-significant-cloud-height">2nd Significant Cloud (Height
                                                ft)</label>
                                            <input type="number" id="second-significant-cloud-height" name="sch2"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="second-individual-cloud-layer-type">2nd Individual Cloud Layer
                                                Type</label>
                                            <select class="select2" id="second-individual-cloud-layer-type"
                                                name="iclt2">
                                                <option value="" disabled selected>Select Type</option>
                                                <option value="CB">CB</option>
                                                <option value="TCU">TCU</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="third-significant-cloud-oktas">3rd Significant Cloud
                                                (Oktas)</label>
                                            <select class="select2" id="third-significant-cloud-oktas" name="sco3">
                                                <option value="" disabled selected>Select Oktas</option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="third-significant-cloud-height">3rd Significant Cloud (Height
                                                ft)</label>
                                            <input type="number" id="third-significant-cloud-height" name="sch3"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="fourth-significant-cloud-oktas">4th Significant Cloud
                                                (Oktas)</label>
                                            <select class="select2" id="fourth-significant-cloud-oktas" name="sco4">
                                                <option value="" disabled selected>Select Oktas</option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="fourth-significant-cloud-height">4th Significant Cloud (Height
                                                ft)</label>
                                            <input type="number" id="fourth-significant-cloud-height" name="sch4"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-12 form-group">
                                            <h5><b>Temperature and Pressure</b></h5>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="dry-bulb-temperature">Dry Bulb Temperature (°C)</label>
                                            <input type="number" id="dry-bulb-temperature" name="d_b_t"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wet-bulb-temperature">Wet Bulb Temperature (°C)</label>
                                            <input type="number" id="wet-bulb-temperature" name="w_b_t"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="g_b_re_v">Gun Bellean Reset Value</label>
                                            <input type="number" id="g_b_re_v" name="g_b_re_v" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="g_b_r_v">Gun Bellean Read Value</label>
                                            <input type="number" id="g_b_r_v" name="g_b_r_v" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="d_p_t">Dew point Temperature</label>
                                            <input type="number" id="d_p_t" name="d_p_t" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="ma_t">Maximum Temperature</label>
                                            <input type="number" id="ma_t" name="ma_t" class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="mi_t">Minimum Temperature</label>
                                            <input type="number" id="mi_t" name="mi_t" class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="qnh-hpa">QNH (hPa)</label>
                                            <input type="number" id="qnh-hpa" name="qnh_h" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="qnh-whole">QNH (Whole)</label>
                                            <input type="number" id="qnh-whole" name="qnh_w" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="clp-hpa">C.L.P (hPa)</label>
                                            <input type="number" id="clp-hpa" name="c_l_p" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="mslp">M.S.L.P (hPa)</label>
                                            <input type="number" id="mslp" name="mslp" class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="gpm">GPM (mm)</label>
                                            <input type="number" id="gpm" name="gpm" class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="vapor-temperature">Vapor Pressure (hpa)</label>
                                            <input type="number" id="vapor-temperature" name="v_t" class="form-control"
                                                step="any">
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="relative-humidity">Relative Humidity (%)</label>
                                            <input type="number" id="relative-humidity" name="r_h" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="w_r">Wind Run</label>
                                            <input type="number" id="w_r" name="w_r" class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="t_p_a_a_24">Total Precipitation (Past 24 hours)</label>
                                            <input type="number" id="t_p_a_a_24" name="t_p_a_a_24" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-12 form-group">
                                            <h5><b>Additional Information</b></h5>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="trend">Trend</label>
                                            <input type="text" id="trend" name="trend" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" id="remarks" name="remarks" class="form-control">
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