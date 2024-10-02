<?php require_once "inc/session.php"; ?>
<?php require_once "inc/db.php"; ?>
<?php require_once "inc/function.php"; ?>
<?php 
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login(); 
$id = $_GET['id'];
if (isset($_POST["submit"])) 

{
    $time_of_observation = $_POST['t_o_o'];
    $wind_direction =!empty($_POST['w_d']) ? $_POST['w_d'] : null;
    $wind_speed = !empty($_POST['w_s']) ? $_POST['w_s'] : null;
    $visibility = !empty($_POST['visib']) ? $_POST['visib'] : null;
    $present_weather = !empty($_POST['p_w']) ? $_POST['p_w'] : null;
    $total_sky_cloud_cover = !empty($_POST['tscc']) ? $_POST['tscc'] : null;
    $first_significant_cloud_oktas = !empty($_POST['sco1']) ? $_POST['sco1'] : null;
    $first_significant_cloud_height = !empty($_POST['sch1']) ? $_POST['sch1'] : null;
    $second_significant_cloud_oktas = !empty($_POST['sco2']) ? $_POST['sco2'] : null;
    $second_significant_cloud_height = !empty($_POST['sch2']) ? $_POST['sch2'] : null;
    $second_individual_cloud_layer_type = !empty($_POST['iclt2']) ? $_POST['iclt2'] : null;
    $third_significant_cloud_oktas = !empty($_POST['sco3']) ? $_POST['sco3'] : null;
    $third_significant_cloud_height = !empty($_POST['sch3']) ? $_POST['sch3'] : null;
    $fourth_significant_cloud_oktas = !empty($_POST['sco4']) ? $_POST['sco4'] : null;
    $fourth_significant_cloud_height = !empty($_POST['sch4']) ? $_POST['sch4'] : null;
    $dry_bulb_temperature = !empty($_POST['d_b_t']) ? $_POST['d_b_t'] : null;
    $dew_point_temperature = !empty($_POST['d_p_t']) ? $_POST['d_p_t'] : null;
    $qnh_h = !empty($_POST['qnh_h']) ? $_POST['qnh_h'] : null;
    $qnh_w = !empty($_POST['qnh_w']) ? $_POST['qnh_w'] : null;
    $clp_h = !empty($_POST['c_l_p']) ? $_POST['c_l_p'] : null;
    $mslp = !empty($_POST['mslp']) ? $_POST['mslp'] : null;
    $gpm = !empty($_POST['gpm']) ? $_POST['gpm'] : null;
    $vapor_temperature = !empty($_POST['v_t']) ? $_POST['v_t'] : null;
    $relative_humidity = !empty($_POST['r_h']) ? $_POST['r_h'] : null;
    $wet_bulb_temperature =!empty($_POST['w_b_t']) ? $_POST['w_b_t'] : null;
    $trend = !empty($_POST['trend']) ? $_POST['trend'] : null;
    $remarks = !empty($_POST['remarks']) ? $_POST['remarks'] : null;
    $user_id = $_SESSION['userid'];

    $sql = "UPDATE metar SET 
    time_of_observation = :time_of_observation, 
    wind_direction = :wind_direction, 
    wind_speed = :wind_speed, 
    visibility = :visibility, 
    present_weather = :present_weather, 
    total_sky_cloud_cover = :total_sky_cloud_cover, 
    first_significant_cloud_oktas = :first_significant_cloud_oktas, 
    first_significant_cloud_height = :first_significant_cloud_height, 
    second_significant_cloud_oktas = :second_significant_cloud_oktas, -- Add this line
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
    clp_h = :clp_h, 
    mslp = :mslp, 
    gpm = :gpm, 
    vapor_temperature = :vapor_temperature, 
    relative_humidity = :relative_humidity, 
    wet_bulb_temperature = :wet_bulb_temperature, 
    trend = :trend, 
    remarks = :remarks 
    WHERE id = :user_id";


    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':time_of_observation', $time_of_observation, PDO::PARAM_STR);
    $stmt->bindParam(':wind_direction', $wind_direction, PDO::PARAM_STR);
    $stmt->bindParam(':wind_speed', $wind_speed, PDO::PARAM_STR);
    $stmt->bindParam(':visibility', $visibility, PDO::PARAM_STR);
    $stmt->bindParam(':present_weather', $present_weather, PDO::PARAM_STR);
    $stmt->bindParam(':total_sky_cloud_cover', $total_sky_cloud_cover, PDO::PARAM_STR);
    $stmt->bindParam(':first_significant_cloud_oktas', $first_significant_cloud_oktas, PDO::PARAM_STR);
    $stmt->bindParam(':first_significant_cloud_height', $first_significant_cloud_height, PDO::PARAM_STR);
    $stmt->bindParam(':second_significant_cloud_oktas', $second_significant_cloud_oktas, PDO::PARAM_STR);
    $stmt->bindParam(':second_significant_cloud_height', $second_significant_cloud_height, PDO::PARAM_STR);
    $stmt->bindParam(':second_individual_cloud_layer_type', $second_individual_cloud_layer_type, PDO::PARAM_STR);
    $stmt->bindParam(':third_significant_cloud_oktas', $third_significant_cloud_oktas, PDO::PARAM_STR);
    $stmt->bindParam(':third_significant_cloud_height', $third_significant_cloud_height, PDO::PARAM_STR);
    $stmt->bindParam(':fourth_significant_cloud_oktas', $fourth_significant_cloud_oktas, PDO::PARAM_STR);
    $stmt->bindParam(':fourth_significant_cloud_height', $fourth_significant_cloud_height, PDO::PARAM_STR);
    $stmt->bindParam(':dry_bulb_temperature', $dry_bulb_temperature, PDO::PARAM_STR);
    $stmt->bindParam(':wet_bulb_temperature', $wet_bulb_temperature, PDO::PARAM_STR);
    $stmt->bindParam(':g_reset', $g_reset, PDO::PARAM_STR);
    $stmt->bindParam(':g_read', $g_read, PDO::PARAM_STR);
    $stmt->bindParam(':dew_point_temperature', $dew_point_temperature, PDO::PARAM_STR);
    $stmt->bindParam(':max_temp', $max_temperature, PDO::PARAM_STR);
    $stmt->bindParam(':min_temp', $min_temperature, PDO::PARAM_STR);
    $stmt->bindParam(':qnh_h', $qnh_h, PDO::PARAM_STR);
    $stmt->bindParam(':qnh_w', $qnh_w, PDO::PARAM_STR);
    $stmt->bindParam(':clp_h', $clp_h, PDO::PARAM_STR);
    $stmt->bindParam(':mslp', $mslp, PDO::PARAM_STR);
    $stmt->bindParam(':gpm', $gpm, PDO::PARAM_STR);
    $stmt->bindParam(':vapor_pressure', $vapor_temperature, PDO::PARAM_STR);
    $stmt->bindParam(':relative_humidity', $relative_humidity, PDO::PARAM_STR);
    $stmt->bindParam(':wind_run', $wind_run, PDO::PARAM_STR);
    $stmt->bindParam(':total_p_24h', $total_precipitation_24h, PDO::PARAM_STR);
    $stmt->bindParam(':trend', $trend, PDO::PARAM_STR);
    $stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);



    $result = $stmt->execute();


    if ($result) {
        $_SESSION["SuccessMessage"] = "Metar Data updated successfully";
        header("Location: view_metar_data.php");
        exit();
    } else {
        $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
        header("Location: editmetar.php?id=$id");
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
    <div id="wrapper" class="wrapper bg-ash">
        <?php include 'inc/navbar.php'  ?>
        <div class="dashboard-page-one">
            <?php include  'inc/sidebar.php'?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                </div>
                <?php
                            $sql  = "SELECT * FROM metar WHERE id='$id'";
                            $stmt = $conn ->query($sql);
                            while ($rows=$stmt->fetch()) 
                            {
                            $id    = $rows['id'];
                            $time_of_observation = $rows['time_of_observation'];
                            $wind_direction   = $rows['wind_direction'];
                            $wind_speed = $rows["wind_speed"];
                            $visibility   = $rows['visibility'];
                            $present_weather = $rows["present_weather"];
                            $total_sky_cloud_cover  = $rows['total_sky_cloud_cover'];
                            $first_significant_cloud_oktas   = $rows['first_significant_cloud_oktas'];
                            $first_significant_cloud_height   = $rows['first_significant_cloud_height'];
                            $second_significant_cloud_oktas   = $rows['second_significant_cloud_oktas'];
                            $second_significant_cloud_height   = $rows['second_significant_cloud_height'];
                            $second_individual_cloud_layer_type   = $rows['second_individual_cloud_layer_type'];
                            $third_significant_cloud_oktas   = $rows['third_significant_cloud_oktas'];
                            $third_significant_cloud_height   = $rows['third_significant_cloud_height'];
                            $fourth_significant_cloud_oktas   = $rows['fourth_significant_cloud_oktas'];
                            $fourth_significant_cloud_height  = $rows['fourth_significant_cloud_height'];
                            $dry_bulb_temperature   = $rows['dry_bulb_temperature'];
                            $wet_bulb_temperature   = $rows['wet_bulb_temperature'];
                            $g_reset  = $rows['g_reset'];
                            $g_read   = $rows['g_read'];
                            $dew_point_temperature   = $rows['dew_point_temperature'];
                            $max_temperature   = $rows['max_temperature'];
                            $min_temperature = $rows['min_temperature'];
                            $qnh_hpa  = $rows['qnh_hpa'];
                            $qnh_whole  = $rows['qnh_whole'];
                            $c_l_p = $rows['c_l_p'];
                            $mslp   = $rows['mslp'];
                            $gpm  = $rows['gpm'];
                            $vapor_pressure = $rows['vapor_pressure'];
                            $relative_humidity  = $rows['relative_humidity'];
                            $wind_run  = $rows['wind_run'];
                            $total_precipitation_24h = $rows['total_precipitation_24h'];
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
                                        <h3><b>Edit METAR Report</b></h3>
                                    </div>
                                    <div class="dropdown">

                                    </div>
                                </div>
                                <form class="new-added-form" method="POST" action="editmetar.php?id=<?php echo $id; ?>">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="time-of-observation">Time of Observation (UTC)</label>
                                            <select class="select2" id="time-of-observation" name="time_of_observation" 
                                                value="<?php echo $time_of_observation ?>" required>
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
                                                value="<?php echo $wind_direction  ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind-speed">Wind Speed (KT)</label>
                                            <input type="number" id="wind-speed" name="wind_speed" class="form-control"
                                                value="<?php echo $wind_speed ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="visibility">Visibility</label>
                                            <input type="text" id="visibility" name="visibility"  class="form-control"
                                                value="<?php echo $visibility  ?>">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="present-weather">Present Weather</label>
                                            <input type="text" id="present-weather" name="present_weather" class="form-control"
                                                value="<?php echo $present_weather ?>">
                                        </div>
                                        <div class="col-12 form-group">
                                            <h5><b>Cloud Information</b></h5>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="total-sky-cloud-cover">Total Sky Cloud Cover (Oktas)</label>
                                            <input type="number" id="total-sky-cloud-cover" name="tscc"
                                                class="form-control" value="<?php echo $total_sky_c_c ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="first-significant-cloud-oktas">1st Significant Cloud
                                                (Oktas)</label>
                                            <select class="select2" id="first-significant-cloud-oktas" name="sco1"
                                                value="<?php echo $first_s_c_o  ?>">
                                                <option value="" disabled selected>Select Oktas</option>
                                                <<option value="1">1</option>
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
                                                class="form-control"
                                                value="<?php echo $first_significant_cloud_height   ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="second-significant-cloud-oktas">2nd Significant Cloud
                                                (Oktas)</label>
                                            <select class="select2" id="second-significant-cloud-oktas" name="sco2"
                                                value="<?php echo $second_significant_cloud_oktas ?>">
                                                <option value="" disabled selected>Select Oktas</option>
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
                                                class="form-control"
                                                value="<?php echo $second_significant_cloud_height  ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="second-individual-cloud-layer-type">2nd Individual Cloud Layer
                                                Type</label>
                                            <select class="select2" id="second-individual-cloud-layer-type"
                                                value="<?php echo $second_individual_cloud_layer_type ?>" name="iclt2">
                                                <option value="" disabled selected></option>
                                                <option value="CB">CB</option>
                                                <option value="TCU">TCU</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="third-significant-cloud-oktas">3rd Significant Cloud
                                                (Oktas)</label>
                                            <select class="select2" id="third-significant-cloud-oktas"
                                                value="<?php echo $third_significant_cloud_oktas ?>" name="sco3">
                                                <option value="" disabled selected>Select Oktas</option>
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
                                                value="<?php echo $third_significant_cloud_height  ?>"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="fourth-significant-cloud-oktas">4th Significant Cloud
                                                (Oktas)</label>
                                            <select class="select2" id="fourth-significant-cloud-oktas"
                                                value="<?php echo $fourth_significant_cloud_oktas   ?>" name="sco4">
                                                <option value="" disabled selected>Select Oktas</option>
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
                                                value="<?php echo $fourth_significant_cloud_height  ?>"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-12 form-group">
                                            <h5><b>Temperature and Pressure</b></h5>
                                        </div>
                                     
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="dry-bulb-temperature">Dry Bulb Temperature (°C)</label>
                                            <input type="number" id="dry-bulb-temperature" value="<?php echo $fourth_significant_cloud_height  ?>" name="d_b_t"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wet-bulb-temperature">Wet Bulb Temperature (°C)</label>
                                            <input type="number" id="wet-bulb-temperature" value="<?php echo $fourth_significant_cloud_height  ?>" name="w_b_t"
                                                class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="g_b_re_v">Gun Bellean Reset Value</label>
                                            <input type="number" id="g_b_re_v" name="g_b_re_v" value="<?php echo $fourth_significant_cloud_height  ?>" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="g_b_r_v">Gun Bellean Read Value</label>
                                            <input type="number" id="g_b_r_v" name="g_b_r_v" value="<?php echo $fourth_significant_cloud_height  ?>" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="dew-point-temperature">Dew Point Temperature (°C)</label>
                                            <input type="number" id="dew-point-temperature" name="d_p_t"
                                                class="form-control" value="<?php echo $dew_point_temperature ?>"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="ma_t">Maximum Temperature</label>
                                            <input type="number" id="ma_t" name="ma_t" value="<?php echo $qnh_h  ?>"  class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="mi_t">Minimum Temperature</label>
                                            <input type="number" id="mi_t" name="mi_t" value="<?php echo $qnh_h  ?>"  class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="qnh-hpa">QNH (hPa)</label>
                                            <input type="number" id="qnh-hpa" name="qnh_h" class="form-control"
                                                value="<?php echo $qnh_h  ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="qnh-whole">QNH (Whole)</label>
                                            <input type="number" id="qnh-whole" name="qnh_w" class="form-control"
                                                value="<?php echo $qnh_w ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="clp-hpa">C.L.P (hPa)</label>
                                            <input type="number" id="clp-hpa" name="c_l_p" class="form-control"
                                                value="<?php echo $clp_h  ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="mslp">M.S.L.P (hPa)</label>
                                            <input type="number" id="mslp" name="mslp" class="form-control"
                                                value="<?php echo $mslp ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="gpm">GPM (mm)</label>
                                            <input type="number" id="gpm" name="gpm" class="form-control"
                                                value="<?php echo $gpm  ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="vapor-temperature">Vapor Pressure</label>
                                            <input type="number" id="vapor-temperature" name="v_p" class="form-control"
                                                value="<?php echo $vapor_temperature  ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="relative-humidity">Relative Humidity (%)</label>
                                            <input type="number" id="relative-humidity" name="r_h" class="form-control"
                                                value="<?php echo $relative_humidity  ?>" step="any">
                                        </div>
 
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wet-bulb-temperature">Wet Bulb Temperature (°C)</label>
                                            <input type="number" id="wet-bulb-temperature" name="w_b_t"
                                                class="form-control" value="<?php echo $wet_bulb_temperature ?>"
                                                step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="ma_t">Maximum Temperature</label>
                                            <input type="number" id="ma_t" name="ma_t" <?php echo $max_temperature ?> class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="mi_t">Minimum Temperature</label>
                                            <input type="number" id="mi_t" name="mi_t" class="form-control" value="<?php echo $min_temperature ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="w_r">Wind Run</label>
                                            <input type="number" id="w_r" name="w_r" value="<?php echo $wind_run  ?>" class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="t_p_a_a_24">Total Precipitation (Past 24 hours)</label>
                                            <input type="number" id="t_p_a_a_24" name="t_p_a_a_24" value="<?php echo $total_precipitation_24h  ?>" class="form-control"
                                                step="any">
                                        </div>
                                        <div class="col-12 form-group">
                                            <h5><b>Additional Information</b></h5>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="trend">Trend</label>
                                            <input type="text" id="trend" name="trend" value="<?php echo $trend  ?>"
                                                class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" id="remarks" name="remarks"
                                                value="<?php echo $remarks ?>" class="form-control">
                                        </div>
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
            </script>
</body>

</html>