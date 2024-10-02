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
            <?php include  'inc/sidebar.php' ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                <h3> <?php echo $name ?> Station</h3>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3> SYNOP Report Generation</h3>
                                    </div>
                                </div>                    
                                <form class="new-added-form" method="POST" action="inc/synopbackend.php">
                             <div class="row">

        <!-- Observation Details -->
        <h3 class="col-12"><b>Observation Details</b></h3>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="time-of-observation">Time of Observation (UTC)</label>
            <select class="select2" id="time-of-observation" name="t_o_o" required>
                <option value="" disabled selected>Select time</option>
                <option value="0000">0000</option>
                <option value="0300">0300</option>
                <option value="0600">0600</option>
                <option value="0900">0900</option>
                <option value="1200">1200</option>
                <option value="1500">1500</option>
                <option value="1800">1800</option>
                <option value="2100">2100</option>
            </select>
        </div>

      
        <!-- Station and Wind Information -->
        <h3 class="col-12"><b>Station and Wind Information</b></h3>
      
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="w_m_i_u">Wind Measuring Instruments (iw)</label>
            <select class="select2" id="w_m_i_u" name="w_m_i_u">
                <option value="" disabled selected></option>
                <option value="0">Wind speed estimated and Wind speed in metres per second (0)</option>
                <option value="1">Wind speed obtained from anemometer and Wind speed in metres per second (1)</option>
                <option value="3">Wind speed estimated and Wind speed in knots (3)</option>
                <option value="4">Wind speed obtained from anemometer and Wind speed in knots (4)</option>
                <option value="">Wind speed not available (/)</option>
            </select>
        </div>


        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="i_f_i_o_p">Indicator for Precipitation Data (iR)</label>
            <select class="select2" id="i_f_i_o_p" name="i_f_i_o_p">
            <option value="" disabled selected></option>
                <option value="0">In Sections 1 and 3 Group 6RRRtR is Included in both sections (0)</option>
                <option value="1">In Section 1 Group 6RRRtR is Included (1)</option>
                <option value="2">In Section 3 Group 6RRRtR is Included (2)</option>
                <option value="3">In none of the two Sections 1 and 3 Group 6RRRtR is Omitted (precipitation amount equal to 0) (3)</option>
                <option value="4">In none of the two Sections 1 and 3 Group 6RRRtR is Omitted (precipitation amount not available) (4)</option>
            </select>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="type">Station Operation and Weather:</label>
            <select class="select2" id="type" name="type">
            <option value="" disabled selected></option>
                <option value="1">Manned Group 7wwW1W2 or 7wawaWa1Wa2 Included (1)</option>
                <option value="2">Manned Group 7wwW1W2 or 7wawaWa1Wa2 Omitted (no significant phenomenon to report) (2)</option>
                <option value="3">Manned Group 7wwW1W2 or 7wawaWa1Wa2 Omitted (no observation or data not available) (3)</option>
                <option value="4">Automatic Group 7wwW1W2 or 7wawaWa1Wa2 Included (4)</option>
                <option value="5">Automatic Group 7wwW1W2 or 7wawaWa1Wa2 Omitted (no significant phenomenon to report) (5)</option>
                <option value="6">Automatic Group 7wwW1W2 or 7wawaWa1Wa2 Omitted (no observation or data not available) (6)</option>
                <option value="7">Automatic Group 7wwW1W2 or 7wawaWa1Wa2 Included (7)</option>
            </select>
        </div>

        <!-- Cloud and Visibility Information -->
        <h3 class="col-12"><b>Cloud and Visibility Information</b></h3>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="height_above_s_b_l_c_s">Height of Lowest Cloud Base (h)</label>
            <select class="select2" id="height_above_s_b_l_c_s" name="height_above_s_b_l_c_s">
                                                <option value="" disabled selected></option>
                                                <option value="0">0 to 50m or 0 to 100ft (0)</option>
                                                <option value="1">50 to 100m or 100 t0 300ft (1)</option>
                                                <option value="2">100 to 200m or 300 to 600ft (2)</option>
                                                <option value="3">200 to 300m or 600 to 900ft (3)</option>
                                                <option value="4">300 to 600m or 900 to 1900ft (4)</option>
                                                <option value="5">600 to 1000m or 1900 to 3200ft (5)</option>
                                                <option value="6">1000 to 1500m or 3200 to 4900ft (6)</option>
                                                <option value="7">1500 to 2000m or 4900 to 6500ft (7)</option>
                                                <option value="8">2000 to 2500m or 6500 to 8000ft (8)</option>
                                                <option value="9">2500m or 8000ft or more or no clouds (9)</option>
                                                <option value="">Height of base of cloud not known or base of clouds at a level lower and tops at a level higher than that of the station</option>
            </select>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="visibility">Visibility</label>
            <select class="select2" id="visibility" name="visibility">
                                               <option value="" disabled selected></option>
                                                <option value="<50">less than 50 </option>
                                                <option value="<100">less than 100</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="300">300</option>
                                                <option value="400">400</option>
                                                <option value="500">500</option>
                                                <option value="600">600</option>
                                                <option value="700">700</option>
                                                <option value="800">800</option>
                                                <option value="900">900</option>
                                                <option value="1000">1000</option>
                                                <option value="1100">1100</option>
                                                <option value="1200">1200</option>
                                                <option value="1300">1300</option>
                                                <option value="1400">1400</option>
                                                <option value="1500">1500</option>
                                                <option value="1600">1600</option>
                                                <option value="1700">1700</option>
                                                <option value="1800">1800</option>
                                                <option value="1900">1900</option>
                                                <option value="2000">2000</option>
                                                <option value="2100">2100</option>
                                                <option value="2200">2200</option>
                                                <option value="2300">2300</option>
                                                <option value="2400">2400</option>
                                                <option value="2500">2500</option>
                                                <option value="2600">2600</option>
                                                <option value="2700">2700</option>
                                                <option value="2800">2800</option>
                                                <option value="2900">2900</option>
                                                <option value="3000">3000</option>
                                                <option value="3100">3100</option>
                                                <option value="3200">3200</option>
                                                <option value="3300">3300</option>
                                                <option value="3400">3400</option>
                                                <option value="3500">3500</option>
                                                <option value="3600">3600</option>
                                                <option value="3700">3700</option>
                                                <option value="3800">3800</option>
                                                <option value="3900">3900</option>
                                                <option value="4000">4000</option>
                                                <option value="4100">4100</option>
                                                <option value="4200">4200</option>
                                                <option value="4300">4300</option>
                                                <option value="4400">4400</option>
                                                <option value="4500">4500</option>
                                                <option value="4600">4600</option>
                                                <option value="4700">4700</option>
                                                <option value="4800">4800</option>
                                                <option value="4900">4900</option>
                                                <option value="5000">5000</option>
                                                <option value="6000">6000</option>
                                                <option value="7000">7000</option>
                                                <option value="8000">8000</option>
                                                <option value="9000">9000</option>
                                                <option value="10000">10000</option>
                                                <option value="11000">11000</option>
                                                <option value="12000">12000</option>
                                                <option value="13000">13000</option>
                                                <option value="14000">14000</option>
                                                <option value="15000">15000</option>
                                                <option value="16000">16000</option>
                                                <option value="17000">17000</option>
                                                <option value="18000">18000</option>
                                                <option value="19000">19000</option>
                                                <option value="20000">20000</option>
                                                <option value="21000">21000</option>
                                                <option value="22000">22000</option>
                                                <option value="23000">23000</option>
                                                <option value="24000">24000</option>
                                                <option value="25000">25000</option>
                                                <option value="26000">26000</option>
                                                <option value="27000">27000</option>
                                                <option value="28000">28000</option>
                                                <option value="29000">29000</option>
                                                <option value="30000">30000</option>
                                                <option value="35000">35000</option>
                                                <option value="40000">40000</option>
                                                <option value="45000">45000</option>
                                                <option value="50000">50000</option>
                                                <option value="55000">55000</option>
                                                <option value="60000">60000</option>
                                                <option value="65000">65000</option>
                                                <option value="70000">70000</option>
                                                <option value=">70000">greater than 70000</option>
            </select>
</div>
        
 
        <!-- Precipitation Information -->
        <h3 class="col-12"><b>Precipitation Information</b></h3>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="p_d">Precipitation Duration (tR)</label>
            <select class="select2" id="p_d" name="p_d">
        <option value="" disabled selected></option>
                                                <option value="1">6 hours preceding the observation (1)</option>
                                                <option value="2">12 hours preceding the observation (2)</option>
                                                <option value="3">18 hours preceding the observation (3)</option>
                                                <option value="4">24 hours preceding the observation (4)</option>
                                                <option value="5">1 hour preceding the observation (5)</option>
                                                <option value="6">2 hours preceding the observation (6)</option>
                                                <option value="7">3 hours preceding the observation (7)</option>
                                                <option value="8">9 hours preceding the observation (8)</option>
                                                <option value="9">15 hours preceding the observation (9)</option>
            </select>
        </div>
        
        <!-- Weather Conditions -->
        <h3 class="col-12"><b>Weather Conditions</b></h3>
    

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="p_w">Present Weather</label>
            <select class="select2" id="p_w" name="p_w">
        
                                            
                                                
            <option value="" disabled selected></option>
                                                <option value="00">Cloud development not observed or not observable(00)</option>
                                            
                                                <option value="01">Clouds generaly dissolved or becoming less developed(01)</option>
                                            
                                                <option value="02">State of the sky on whole unchanged(02)</option>
                                            
                                                <option value="03">Clouds generally forming or developing(03)</option>
                                            
                                                <option value="04">Visibility reduced by smoke(04)</option>
                                            
                                                <option value="05">Haze(05)</option>
                                            
                                                <option value="06">Widespread dust in suspension in the air, not raised by wind at or near the station at the time of observation-06</option>
                                                
                                                <option value="07">Dust or sand raised by wind at or near the station at the time of observation, but no well developed dust whirl(s) or sand(whirls),
                                                                and no duststorm or sandstorm seen; or in case of sea stations and coastal stations, blowing spray at the station(07)</option>
                                               
                                                <option value="08">Well developed dust whirl(s) or sand whirl(s) seen at or near the station during the preceding hour or at the same time of observation, but no duststorm or sandstorm(08) </option>
                                              
                                                <option value="09">Duststorm or sandstorm within sight at the time of observation, or at the station during preceding hour(09)</option>
                                               
                                                <option value="10">Mist(10)</option>
                                            
                                                <option value="11">Patches of shallow fog or ice at the station, whether on land or sea, not deeper than 2 metres on land or 10 metres at sea(11) </option>
                                                
                                                <option value="12">More or less continuous of shallow fog or ice at the station, whether on land or sea, not deeper than 2 metres on land or 10 metres at sea(12) </option>
                                                
                                                <option value="13">Lightning visible, no thunder heard(13)</option>
                                            
                                                <option value="14">Precipitation within sight, not reaching the ground or the surface of the sea(14)</option>
                                            
                                                <option value="15">Precipitation within sight, reaching the ground or the surface of the sea, but distant,(estimated to be more than 5km from the station)(15)</option>
                                               
                                                <option value="16">Precipitation within sight, reaching the ground or the surface of the sea, near to, but not at the station(16)</option>
                                                
                                                <option value="17">Thunderstorm, but no precipitation at the time of observation(17)</option>
                                            
                                                <option value="18">Squalls at or within sight of the station during the preceding hour or at the time of observation(18)</option>
                                               
                                                <option value="19">Funnel cloud(s) at or within sight of the station during the preceding hour or at the time of observation(19)</option>
                                                
                                                <option value="20">Drizzle (not freezing) or snow grains(20)</option>
                                            
                                                <option value="21">Rain (not freezing)(21)</option>
                                            
                                                <option value="22">Snow(22)</option>
                                            
                                                <option value="23">Rain and Snow or ice pellets(23)</option>
                                            
                                                <option value="24">Freezing drizzle or freezing rain(24)</option>
                                            
                                                <option value="25">Shower(s) of rain(25)</option>
                                            
                                                <option value="26">Shower(s) of snow, or of rain and snow(26)</option>
                                            
                                                <option value="27">Shower(s) of hail, or of rain and hail(27)</option>
                                            
                                                <option value="28">Fog or ice fog(28)</option>
                                            
                                                <option value="29">Thunderstorm (with or without precipitation)(29)</option>
                                            
                                                <option value="30"> Slight or moderate duststorm or sandstorm has decreased during the preceding hour(30)</option>
                                            
                                                <option value="31">Slight or moderate duststorm or sandstorm no appreciable change during the preceding hour(31)</option>
                                            
                                                <option value="32">Slight or moderate duststorm or sandstorm has begun or has increased during the preceding hour(32)</option>
                                            
                                                <option value="33">Severe duststorm or sandstorm has decreased during the preceding hour(33)</option>
                                            
                                                <option value="34">Severe duststorm or sandstorm no appreciable change during the preceding hour(34)</option>
                                            
                                                <option value="35">Severe duststorm or sandstorm has begun or has increased during the preceding hour(35)</option>
                                            
                                                <option value="36">Slight or Moderate drifting snow generally low (below eye level)(36)</option>
                                            
                                                <option value="37">Heavy drifting snow generally low (below eye level)(37)</option>
                                            
                                                <option value="38">Slight or Moderate blowing snow generally high (above eye level)(38)</option>
                                            
                                                <option value="39">Heavy blowing snow generally high (above eye level)(39)</option>
                                            
                                                <option value="40">Fog or ice fog at a distance at time of observation, but not at the station during the preceding hour, the fog or ice fog extending to level above that of the observer(40)</option>
                                            
                                                <option value="41">Fog or ice fog in patches(41)</option>
                                            
                                                <option value="42">Fog or ice fog, sky visible has become thinner during the preceding hour(42)</option>
                                            
                                                <option value="43">Fog or ice fog, sky invisible has become thinner during the preceding hour(43)</option>
                                            
                                                <option value="44">Fog or ice fog, sky visible no appreciable change during the preceding hour(44)</option>
                                            
                                                <option value="45">Fog or ice fog, sky invisible no appreciable change during the preceding hour(45)</option>
                                            
                                                <option value="46">Fog or ice fog, sky visible has begun or has become thicker during the preceding hour(46)</option>
                                            
                                                <option value="47">Fog or ice fog, sky invisible has begun or has become thicker during the preceding hour(47)</option>
                                            
                                                <option value="48">Fog, depositing rime sky visible(48)</option>
                                            
                                                <option value="49">Fog, depositing rime sky invisible(49)</option>
                                            
                                                <option value="50">Drizzle, not freezing, intermittent slight at time of observation(50)</option>
                                            
                                                <option value="51">Drizzle, not freezing, continuos slight at time of observation(51)</option>
                                            
                                                <option value="52">Drizzle, not freezing, intermittent moderate at time of observation(52)</option>
                                            
                                                <option value="53">Drizzle, not freezing, continous moderate at time of observation(53)</option>
                                            
                                                <option value="54">Drizzle, not freezing, intermittent heavy (dense) at time of observation(54)</option>
                                            
                                                <option value="55">Drizzle, not freezing, continous heavy (dense) at time of observation(55)</option>
                                            
                                                <option value="56">Drizzle, freezing, slight(56)</option>
                                            
                                                <option value="57">Drizzle, freezing, moderate or heavy (dense)(57)</option>
                                            
                                                <option value="58">Drizzle and rain, slight(58)</option>
                                            
                                                <option value="59">Drizzle and rain, moderate or heavy(59)</option>
                                            
                                                <option value="60">Rain, not freezing, intermittent slight at time of observation(60)</option>
                                            
                                                <option value="61">Rain, not freezing, continuos slight at time of observation(61)</option>
                                            
                                                <option value="62">Rain, not freezing, intermittent moderate at time of observation(62)</option>
                                            
                                                <option value="63">Rain, not freezing, continous moderate at time of observation(63)</option>
                                            
                                                <option value="64">Rain, not freezing, intermittent heavy at time of observation(64)</option>
                                            
                                                <option value="65">Rain, not freezing, continous heavy at time of observation(65)</option>
                                            
                                                <option value="66">Rain, freezing, slight(66)</option>
                                            
                                                <option value="67">Rain, freezing, moderate or heavy(67)</option>
                                            
                                                <option value="68">Rain or Drizzle and snow, light(68)</option>
                                            
                                                <option value="69">Rain or Drizzle and snow, moderate or heavy(69)</option>
                                            
                                                <option value="70">Intermitent fall of snowflakes slight at time of observation(70)</option>
                                            
                                                <option value="71">Continous fall of snowflakes slight at time of observation(71)</option>
                                            
                                                <option value="72">Intermitent fall of snowflakes moderate at time of observation(72)</option>
                                            
                                                <option value="73">Continous fall of snowflakes moderate at time of observation(73)</option>
                                            
                                                <option value="74">Intermitent fall of snowflakes heavy at time of observation(74)</option>
                                            
                                                <option value="75">Continous fall of snowflakes heavy at time of observation(75)</option>
                                                
                                                <option value="76">Diamond dust (with or without fog)(76)</option>
                                               
                                                <option value="77">Snow grains (with or without fog)(77)</option>
                                               
                                                <option value="78">Isolated star like snow crystals (with or without fog)(78)</option>
                                               
                                                <option value="79">Ice pellets(79)</option>
                                              
                                                <option value="80">Rain shower(s), slight(80)</option>
                                                
                                                <option value="81">Rain shower(s), moderate or heavy(81)</option>
                                                
                                                <option value="82">Rain shower(s), violent(82)</option>
                                                
                                                <option value="83">Shower(s) of rain and snow mixed, slight(83)</option>
                                               
                                                <option value="84">Shower(s) of rain and snow mixed, moderate or heavy(84)</option>
                                                
                                                <option value="85">Snow shower(s), slight(85)</option>
                                                
                                                <option value="86">Snow shower(s), moderate or heavy(86)</option>
                                              
                                                <option value="87">Shower(s) of snow pellets or small hail, with or without rain or rain and snow mixed slight(87)</option>
                                                <option value="88">Shower(s) of snow pellets or small hail, with or without rain or rain and snow mixed moderate or heavy(88)</option>
                                                
                                                <option value="89">Shower(s) of hail, with or without rain or rain and snow mixed, not associated with thunder slight(89)</option>
                                                
                                                <option value="90" >Shower(s) of hail, with or without rain or rain and snow mixed, not associated with thunder moderate or heavy(90)</option>
                                                
                                                <option value="91">Slight rain at time of observation. thunderstorm during the preceding hour but not at time of observation(91)</option>
                                                
                                                <option value="92">Moderate or heavy rain at time of observation. thunderstorm during the preceding hour but not at time of observation(92)</option>
                                                
                                                <option value="93">Slight snow, or rain and snow mixed or hail at time of observation. thunderstorm during the preceding hour but not at time of observation(93)</option>
                                                
                                                <option value="94">Moderate or heavy snow, or rain and snow mixed or hail at time of observation, Thunderstorm during the preceding hour but not at time of observation(94)</option>
                                                <option value="95">Thunderstorm, slight or moderate, without hail, but with rain and/or snow at time of observation. Thunderstorm at time of observation(95)</option>
                                                
                                                <option value="96">Thunderstorm, slight or moderate, with hail at time of observation,Thunderstorm at time of observation(96)</option>
                                                
                                                <option value="97">Thunderstorm, Heavy, without hail, but with rain and/or snow at time of observation. Thunderstorm at time of observation(97)</option>
                                               
                                                <option value="98">Thunderstorm, combined with duststorm or sandstorm at time of observation. Thunderstorm at time of observation(98)</option>
                                                
                                                <option value="99">Thunderstorm, heavy, with hail at time of observation Thunderstorm at time of observation(99)</option>
                                                
            </select>
        </div>
       
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="pa_w1">Past Weather (W1)</label>
            <select class="select2" id="pa_w1" name="pa_w1">
            <option value="" disabled selected></option>
                                                <option value="0">Cloud covering (0.5) or less of the sky throughout appropriate period (0)</option>
                                                <option value="1">Cloud covering more than (0.5) of the sky during part of the appropriate period
                                                   <br>and covering (0.5) or less during part of period-1 <br>
                                                ["In order the system to detect the code, Please select the 1st line if this group is your choice"]</option>
                                            
                                                <option value="2">Cloud covering more than (0.5) of the sky throughout appropriate period (2)</option>
                                            
                                                <option value="3">Sandstorm, duststorm or blowing snow (3)</option>
                                            
                                                <option value="4">Fog or ice fog or thick haze (4)</option>
                                            
                                                <option value="5">Drizzle (5)</option>
                                            
                                                <option value="6">Rain (6)</option>
                                            
                                                <option value="7">Snow, or rain and snow mixed (7)</option>
                                            
                                                <option value="8">Shower(s) (8)</option>
                                            
                                                <option value="9">Thunderstorm(s) with or without precipitation (9)</option>
                                            
            </select>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="pa_w2">Past Weather (W2)</label>
            <select class="select2" id="pa_w2" name="pa_w2">
            <option value="" disabled selected></option>
                                                <option value="0">Cloud covering (0.5) or less of the sky throughout appropriate period (0)</option>
                                            
                                                <option value="1">Cloud covering more than (0.5) of the sky during part of the appropriate period <br>
                                                and covering (0.5) or less during part of period-1 <br>
                                                ["In order the system to detect the code, Please select the 1st line if this group is your choice"]</option>
                                            
                                                <option value="2">Cloud covering more than (0.5) of the sky throughout appropriate period (2)</option>
                                            
                                                <option value="3">Sandstorm, duststorm or blowing snow (3)</option>
                                            
                                                <option value="4">Fog or ice fog or thick haze (4)</option>
                                            
                                                <option value="5">Drizzle (5)</option>
                                            
                                                <option value="6">Rain (6)</option>
                                            
                                                <option value="7">Snow, or rain and snow mixed (7)</option>
                                            
                                                <option value="8">Shower(s) (8)</option>
                                            
                                                <option value="9">Thunderstorm(s) with or without precipitation (9)</option>
                                            
            </select>
        </div>
   
              <!-- Additional Parameters -->
        <h3 class="col-12"><b>Additional Parameters</b></h3>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="l_l_c_t">Low Level Cloud Type</label>
            <select class="select2" id="l_l_c_t" name="l_l_c_t">
            <option value="" disabled selected></option>
            <option value="0">No low clouds (0)</option>                                            
                                                <option value="1">Cumulus humilis or cumulus fractus other than of bad weather, or both (1)</option>                                           
                                                <option value="2">Cumulus mediocris or congestus, with or without,cumulus of species fractus or humilis or 
                                                                stratocumulus,all having their bases at the same level (2)</option>
                                                <option value="3">Cumulonimbus calvus, with or without cumulus, stratocumulus or stratus (3)</option>                                           
                                                <option value="4">Stratocumulus cumulogenitus (4)</option>                                           
                                                <option value="5">Stratocumulus other than stratocumulus cumulogenitus (5)</option>                                           
                                                <option value="6">Stratus nebulosus or stratus fractus other than of bad weather, or both (6)</option>                                           
                                                <option value="7">Stratus fractus or cumulus fractus of bad weather, or both (pannus), usually below altostratus or 
                                                                 nimbostratus (7)</option>                                                
                                                <option value="8">Cumulus and stratocumulus other than stratocumulus cumulogenius, with base at different levels (8)</option>                                            
                                                <option value="9">Cumulonimbus capillatus (often with an anvil),with or without cumulonimbus calvus, cumulus,stratocumulus,
                                                                 stratus or pannus (9)</option>                                               
                                                <option value="10">Clouds invisible owing to darkness, fog, blowing dust or sand, or other similar phenomena(/)</option>   
                                          
            </select>
        </div>
 

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="m_l_c_t"> Medium Level Cloud Type</label>
            <select class="select2" id="m_l_c_t" name="m_l_c_t">
        
            <option value="" disabled selected></option>
                                                <option value="0">No medium level clouds (0)</option>                                           
                                                <option value="1">Altostratus, the greater part of which is semi-transparent; through this part the sun or moon may be weakly visible, 
                                                                 as through ground glass (Altostratus translucidus) (1)</option>
                                                <option value="2">Altostratus, the greater part of which is sufficiently dense to hide the sun or moon, or nimbostratus 
                                                                 (Altostratus opacus or nimbostratus) (2)</option>
                                                <option value="3"> Altocumulus, the greater part of which is semi-transparent;the various elements of the cloud change only 
                                                                 slowly and are all at a single level (Altocumulus translucidus at a single level) (3)</option>                                                
                                                <option value="4">Patches (often in the form of almonds or fish) of altocumulus, the greater part of which is semi-transparent (lenticular); 
                                                                 the clouds occur at one or more levels and the elements are continually changing in appearance (4)</option>
                                                <option value="5">Altocumulus translucidus in bands, or altocumulus translucidus, in one or more continuous layer (semi-transparent or opaque),
                                                                 progressively invading the sky; these generally thicken as a whole (5)</option>
                                                <option value="6">Altocumulus cumulogenitus (or cumulonimbogenitus) Altocumulus resulting from the spreading out of cumulus or cumulonimbus (6)</option>
                                                <option value="7">Altocumulus translucidus in two or more layers, usually opaque in places,and not progressively invading the sky; or opaque
                                                                 layer of altocumulus, not progressively invading the sky; or altocumulus together with altostratus or nimbostratus (7)</option>
                                                <option value="8">Altocumulus castellanus or floccus, Altocumulus with sproutings in the form of small towers or battlements, or altocumulus 
                                                                 having the appearance of cumuliform (8)</option>                                               
                                                <option value="9">Altocumulus of a chaotic sky, generally at several levels (9)</option>                                           
                                                <option value="10">Clouds invisible owing to darkness, fog, blowing dust, sand, or other phenomena; or because of the 
                                                                presence of a continuous layer of lower clouds (/)</option>
                                                
            </select>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="h_l_c_t">High Level Cloud Type</label>
            <select class="select2" id="h_l_c_t" name="h_l_c_t">
        
            <option value="" disabled selected></option>
                                                <option value="0" >No high level, clouds (0)</option>
                                                <option value="1">Cirrus fibratus, sometimes uncinus Cirrus in the form of filaments, strands or hooks, not progressively invading the sky (1)</option>
                                                <option value="2">Cirrus spissatus, in patches or entangled sheaves, which usually do not increase & sometimes seem to be the remains of 
                                                         the upper part of a cumulonimbus; or cirrus castellanus with sproutings in the form of small turrets; or cirrus having the appearance of cumuliform tufts (2)</option>
                                                <option value="3">Cirrus spissatus cumulonimbogenitus, often in the form of an anvil, being the remains of the upper part of cumulonimbus (3)</option>
                                                <option value="4">Cirrus uncinus or fibratus in the form of hooks, filaments, or both, progressively invading the sky; they generally become denser as a whole (4)</option>
                                                <option value="5">Cirrus (often in bands converging towards 1 point or 2 opposite points of the horizon) and cirrostratus, or cirrostratus alone;in either case, 
                                                         they are progressively invading the sky, and generally growing denser as a whole, but the continuous veil does not reach 45 degrees above the horizon (5)</option>
                                                <option value="6">Cirrus (often in bands converging towards 1 point or 2 opposite points of the horizon) and cirrostratus, or cirrostratus alone; in either case, they 
                                                        are progressively invading the sky, and generally growing denser as a whole; the continuous veil extends more than 45 degrees above the horizon, without the
                                                        sky being totally covered (6)</option>
                                                <option value="7">Cirrostratus covering the whole sky Veil of cirrostratus covering the celestial dome (7)</option>
                                                <option value="8">Cirrostratus not progressively invading the sky and not completely covering the celestial dome (8)</option>
                                                <option value="9">Cirrocumulus alone, or cirrocumulus accompanied by cirrus or cirrostratus, or both, but cirrocumulus is predominant (9)</option>
                                                <option value="">Clouds invisible owing to darkness, fog, blowing dust or sand, or other phenomena, or more often because of the presence of a continuous layer of lower clouds (/)</option>
                                                </select>
                                                
           
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="mi_t">Grass Temperature (TgTg)</label>
            <input type="number" id="mi_t" name="mi_t" class="form-control" step="any">
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="c_i_p">Character and Intensity of Precipitation (Rc)</label>
            <select class="select2" id="c_i_p" name="c_i_p">
            <option value="" disabled selected></option>
                                                <option value="0">No precipitation (0)</option>
                                                <option value="1">Light intermittent (1)</option>
                                                <option value="2">Moderate intermittent (2)</option>
                                                <option value="3">Heavy intermittent (3)</option>
                                                <option value="4">Very heavy intermittent (4)</option>
                                                <option value="5">Light continuos (5)</option>
                                                <option value="6">Moderate continuos (6)</option>
                                                <option value="7">Heavy continuos (7)</option>
                                                <option value="8">Very heavy continuos (8)</option>
                                                <option value="9">Variable alternatively light and heavy (9)</option>
                                                <option value="10">Missing (15)</option>
                                                </select>
        </div>

       

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="n_h_b_e">Hours from Precipitation to Observation (Rt)</label>
            <select class="select2" id="n_h_b_e" name="n_h_b_e">
            <option value="" disabled selected></option>
                                                <option value="1">Less than 1 hour before time of observation (1)</option>
                                                <option value="2">1 to 2hours before time of observation (2)</option>
                                                <option value="3">2 to 3hours before time of observation (3)</option>
                                                <option value="4">3 to 4hours before time of observation (4)</option>
                                                <option value="5">4 to 5hours before time of observation (5)</option>
                                                <option value="6">5 to 6hours before time of observation (6)</option>
                                                <option value="7">6 to 12hours before time of observation (7)</option>
                                                <option value="8">More than 12hours before time of observation (8)</option>
                                                <option value="9">Unknown (9)</option>
                                                </select>
        </div>
    
    <!-- Precipitation Measurements -->
        <h3 class="col-12"><b>Precipitation Measurements</b></h3>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="p_a_f_3">Precipitation Amount (Past 3 hours)</label>
            <input type="number" id="p_a_f_3" name="p_a_f_3" class="form-control" step="any">
        </div>


        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="t_i_e_m">Type of Instrument for Evaporation Measurement</label>
            <select class="select2" id="t_i_e_m" name="t_i_e_m">
            <option value="" disabled selected></option>
                                                <option value="0">USA open pan evaporimeter (without cover) Evaporation(0)</option>
                                                <option value="1">USA open pan evaporimeter (mesh covered) Evaporation(1)</option>
                                                <option value="2">GGI_3000 evaporimeter (sunken) Evaporation(2)</option>
                                                <option value="4">20 m^2 tank(4)</option>
                                                <option value="5">Others(5)</option>
                                                </select>
        </div>

         <!-- Sunshine Information -->
      <h3 class="col-12"><b>Sunshine Information</b></h3>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="c_s_s_c">Sunshine Card Segments (Past 24hrs)</label>
            <input type="number" id="c_s_s_c" name="c_s_s_c" class="form-control" step="any">
        </div>
       
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="n_c_e">Cups Added/Removed (Evaporation)</label>
            <input type="number" id="n_c_e" name="n_c_e" class="form-control" step="any">
        </div>
       
        

        <!-- Cloud Layers -->
        <h3 class="col-12"><b>Cloud Layers</b></h3>
  
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="i_l_c_l_t_1">1st Lowest Cloud Layer Type</label>
            <select class="select2" id="i_l_c_l_t_1" name="i_l_c_l_t_1">
            <option value="" disabled selected></option>
                                                <option value="0">Cirrus-Ci (0)</option>                                                
                                                <option value="1">Cirrocumulus-Cc (1)</option>                                                
                                                <option value="2">Cirrostratus-Cs (2)</option>                                                
                                                <option value="3">Altocumulus-Ac (3)</option>                                                
                                                <option value="4">Altostratus-As (4)</option>                                                
                                                <option value="5">Nimbostratus-Ns (5)</option>                                                
                                                <option value="6">Stratocumulus-Sc (6)</option>                                                
                                                <option value="7">Stratus-St (7)</option>                                                
                                                <option value="8">Cumulus-Cu (8)</option>                                                
                                                <option value="9">Cumulonimbus-Cb (9)</option>                                                
                                                <option value="">Clouds not visible owing to darkness, fog, duststorm, sandstorm, or other analogous phenomena (/)</option>
                                                </select>
        </div>
      
        
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="i_l_c_l_b_h_1">1st Lowest Cloud Layer Base Height</label>
            <select class="select2" id="i_l_c_l_b_h_1" name="i_l_c_l_b_h_1">
            <option value="" disabled selected></option>
                                                <option value="00">Less than 30m or 100ft (00)</option>
                                                <option value="01">30m or 100ft (01)</option>
                                                <option value="02">60m or 200ft (02)</option>
                                                <option value="03">90m or 300ft (03)</option>
                                                <option value="04">120m or 400ft (04)</option>
                                                <option value="05">150m or 500ft (05)</option>
                                                <option value="06">180m or 600ft (06)</option>
                                                <option value="07">210m or 700ft (07)</option>
                                                <option value="08">240m or 800ft (08)</option>
                                                <option value="09">270m or 900ft (09)</option>
                                                <option value="10">300m or 1000ft (10)</option>
                                                <option value="11">330m or 1100ft (11)</option>
                                                <option value="12">360m or 1200ft (12)</option>
                                                <option value="13">390m or 1300ft (13)</option>
                                                <option value="14">420m or 1400ft (14)</option>
                                                <option value="15">450m or 1500ft (15)</option>
                                                <option value="16">480m or 1600ft (16)</option>
                                                <option value="17">510m or 1700ft (17)</option>
                                                <option value="18">540m or 1800ft (18)</option>
                                                <option value="19">570m or 1900ft (19)</option>
                                                <option value="20">600m or 2000ft (20)</option>
                                                <option value="21">630m or 2100ft (21)</option>
                                                <option value="22">660m or 2200ft (22)</option>
                                                <option value="23">690m or 2300ft (23)</option>
                                                <option value="24">720m or 2400ft (24)</option>
                                                <option value="25">750m or 2500ft (25)</option>
                                                <option value="26">780m or 2600ft (26)</option>
                                                <option value="27">810m or 2700ft (27)</option>
                                                <option value="28">840m or 2800ft (28)</option>
                                                <option value="29">870m or 2900ft (29)</option>
                                                <option value="30">900m or 3000ft (30)</option>
                                                <option value="31">930m or 3100ft (31)</option>
                                                <option value="32">960m or 3200ft (32)</option>
                                                <option value="33">990m or 3300ft (33)</option>
                                                <option value="34">1020m or 3400ft (34)</option>
                                                <option value="35">1050m or 3500ft (35)</option>
                                                <option value="36">1080m or 3600ft (36)</option>
                                                <option value="37">1110m or 3700ft (37)</option>
                                                <option value="38">1140m or 3800ft (38)</option>
                                                <option value="39">1170m or 3900ft (39)</option>
                                                <option value="40">1200m or 4000ft (40)</option>
                                                <option value="41">1230m or 4100ft (41)</option>
                                                <option value="42">1260m or 4200ft (42)</option>
                                                <option value="43">1290m or 4300ft (43)</option>
                                                <option value="44">1320m or 4400ft (44)</option>
                                                <option value="45">1350m or 4500ft (45)</option>
                                                <option value="46">1380m or 4600ft (46)</option>
                                                <option value="47">1410m or 4700ft (47)</option>
                                                <option value="48">1440m or 4800ft (48)</option>
                                                <option value="49">1470m or 4900ft (49)</option>
                                                <option value="50">1500m or 5000ft (50)</option>
                                                <option value="56">1800m or 6000ft (56)</option>
                                                <option value="57">2100m or 7000ft (57)</option>
                                                <option value="58">2400m or 8000ft (58)</option>
                                                <option value="59">2700m or 9000ft (59)</option>
                                                <option value="60">3000m or 10000ft (60)</option>
                                                <option value="61">3300m or 11000ft (61)</option>
                                                <option value="62">3600m or 12000ft (62)</option>
                                                <option value="63">3900m or 13000ft (63)</option>
                                                <option value="64">4200m or 14000ft (64)</option>
                                                <option value="65">4500m or 15000ft (65)</option>
                                                <option value="66">4800m or 16000ft (66)</option>
                                                <option value="67">5100m or 17000ft (67)</option>
                                                <option value="68">5400m or 18000ft (68)</option>
                                                <option value="69">5700m or 19000ft (69)</option>
                                                <option value="70">6000m or 20000ft (70)</option>
                                                <option value="71">6300m or 21000ft (71)</option>
                                                <option value="72">6600m or 22000ft (72)</option>
                                                <option value="73">6900m or 23000ft (73)</option>
                                                <option value="74">7200m or 24000ft (74)</option>
                                                <option value="75">7500m or 25000ft (75)</option>
                                                <option value="76">7800m or 26000ft (76)</option>
                                                <option value="77">8100m or 27000ft (77)</option>
                                                <option value="78">8400m or 28000ft (78)</option>
                                                <option value="79">8700m or 29000ft (79)</option>
                                                <option value="80">9000m or 30000ft (80)</option>
                                                <option value="81">10500m or 31000ft (81)</option>
                                                <option value="82">12000m or 32000ft (82)</option>
                                                <option value="83">13500m or 33000ft (83)</option>
                                                <option value="84">15000m or 34000ft (84)</option>
                                                <option value="85">16500m or 35000ft (85)</option>
                                                <option value="86">18000m or 36000ft (86)</option>
                                                <option value="87">19500m or 37000ft (87)</option>
                                                <option value="88">21000m or 38000ft (88)</option>
                                                <option value="89">Greater than 21000m or 38000ft (89)</option>
                                                <option value="90">Less than 50m or 150ft (90)</option>
                                                <option value="91">50 to 100m or 300ft (91)</option>
                                                <option value="92">100 to 200m or 600ft (92)</option>
                                                <option value="93">200 to 300m or 900ft (93)</option>
                                                <option value="94">300 to 600m or 1800ft (94)</option>
                                                <option value="95">600 to 1000m or 3000ft (95)</option>
                                                <option value="96">1000 to 1500m or 4500ft (96)</option>
                                                <option value="97">1500 to 2000m or 6000ft (97)</option>
                                                <option value="98">2000 to 2500m or 7500ft (98)</option>
                                                <option value="99">2500m or 7500ft or more or no clouds (99)</option>
                                                <option value="">Observation not done (/)</option>
                                                </select>
        </div>
   
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="i_l_c_l_t_2">2nd Lowest Cloud Layer Type</label>
            <select class="select2" id="i_l_c_l_t_2" name="i_l_c_l_t_2">
            <option value="" disabled selected></option>
                                                <option value="0">Cirrus-Ci (0)</option>                                               
                                                <option value="1">Cirrocumulus-Cc (1)</option>                                                
                                                <option value="2">Cirrostratus-Cs (2)</option>                                              
                                                <option value="3">Altocumulus-Ac (3)</option>                                               
                                                <option value="4">Altostratus-As (4)</option>                                                
                                                <option value="5">Nimbostratus-Ns (5)</option>                                            
                                                <option value="6">Stratocumulus-Sc (6)</option>                                                
                                                <option value="7">Stratus-St (7)</option>                                                
                                                <option value="8">Cumulus-Cu (8)</option>                                           
                                                <option value="9">Cumulonimbus-C (9)</option>                                                
                                                <option value="">Clouds not visible owing to darkness, fog, duststorm, sandstorm, or other analogous phenomena (/)</option>
                                                </select>
        </div>

   
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="i_l_c_l_b_h_2">2nd Lowest Cloud Layer Base Height</label>
            <select class="select2" id="i_l_c_l_b_h_2" name="i_l_c_l_b_h_2">
            <option value="" disabled selected></option>
            <option value="00">Less than 30m or 100ft (00)</option>
                                                <option value="01">30m or 100ft (01)</option>
                                                <option value="02">60m or 200ft (02)</option>
                                                <option value="03">90m or 300ft (03)</option>
                                                <option value="04">120m or 400ft (04)</option>
                                                <option value="05">150m or 500ft (05)</option>
                                                <option value="06">180m or 600ft (06)</option>
                                                <option value="07">210m or 700ft (07)</option>
                                                <option value="08">240m or 800ft (08)</option>
                                                <option value="09">270m or 900ft (09)</option>
                                                <option value="10">300m or 1000ft (10)</option>
                                                <option value="11">330m or 1100ft (11)</option>
                                                <option value="12">360m or 1200ft (12)</option>
                                                <option value="13">390m or 1300ft (13)</option>
                                                <option value="14">420m or 1400ft (14)</option>
                                                <option value="15">450m or 1500ft (15)</option>
                                                <option value="16">480m or 1600ft (16)</option>
                                                <option value="17">510m or 1700ft (17)</option>
                                                <option value="18">540m or 1800ft (18)</option>
                                                <option value="19">570m or 1900ft (19)</option>
                                                <option value="20">600m or 2000ft (20)</option>
                                                <option value="21">630m or 2100ft (21)</option>
                                                <option value="22">660m or 2200ft (22)</option>
                                                <option value="23">690m or 2300ft (23)</option>
                                                <option value="24">720m or 2400ft (24)</option>
                                                <option value="25">750m or 2500ft (25)</option>
                                                <option value="26">780m or 2600ft (26)</option>
                                                <option value="27">810m or 2700ft (27)</option>
                                                <option value="28">840m or 2800ft (28)</option>
                                                <option value="29">870m or 2900ft (29)</option>
                                                <option value="30">900m or 3000ft (30)</option>
                                                <option value="31">930m or 3100ft (31)</option>
                                                <option value="32">960m or 3200ft (32)</option>
                                                <option value="33">990m or 3300ft (33)</option>
                                                <option value="34">1020m or 3400ft (34)</option>
                                                <option value="35">1050m or 3500ft (35)</option>
                                                <option value="36">1080m or 3600ft (36)</option>
                                                <option value="37">1110m or 3700ft (37)</option>
                                                <option value="38">1140m or 3800ft (38)</option>
                                                <option value="39">1170m or 3900ft (39)</option>
                                                <option value="40">1200m or 4000ft (40)</option>
                                                <option value="41">1230m or 4100ft (41)</option>
                                                <option value="42">1260m or 4200ft (42)</option>
                                                <option value="43">1290m or 4300ft (43)</option>
                                                <option value="44">1320m or 4400ft (44)</option>
                                                <option value="45">1350m or 4500ft (45)</option>
                                                <option value="46">1380m or 4600ft (46)</option>
                                                <option value="47">1410m or 4700ft (47)</option>
                                                <option value="48">1440m or 4800ft (48)</option>
                                                <option value="49">1470m or 4900ft (49)</option>
                                                <option value="50">1500m or 5000ft (50)</option>
                                                <option value="56">1800m or 6000ft (56)</option>
                                                <option value="57">2100m or 7000ft (57)</option>
                                                <option value="58">2400m or 8000ft (58)</option>
                                                <option value="59">2700m or 9000ft (59)</option>
                                                <option value="60">3000m or 10000ft (60)</option>
                                                <option value="61">3300m or 11000ft (61)</option>
                                                <option value="62">3600m or 12000ft (62)</option>
                                                <option value="63">3900m or 13000ft (63)</option>
                                                <option value="64">4200m or 14000ft (64)</option>
                                                <option value="65">4500m or 15000ft (65)</option>
                                                <option value="66">4800m or 16000ft (66)</option>
                                                <option value="67">5100m or 17000ft (67)</option>
                                                <option value="68">5400m or 18000ft (68)</option>
                                                <option value="69">5700m or 19000ft (69)</option>
                                                <option value="70">6000m or 20000ft (70)</option>
                                                <option value="71">6300m or 21000ft (71)</option>
                                                <option value="72">6600m or 22000ft (72)</option>
                                                <option value="73">6900m or 23000ft (73)</option>
                                                <option value="74">7200m or 24000ft (74)</option>
                                                <option value="75">7500m or 25000ft (75)</option>
                                                <option value="76">7800m or 26000ft (76)</option>
                                                <option value="77">8100m or 27000ft (77)</option>
                                                <option value="78">8400m or 28000ft (78)</option>
                                                <option value="79">8700m or 29000ft (79)</option>
                                                <option value="80">9000m or 30000ft (80)</option>
                                                <option value="81">10500m or 31000ft (81)</option>
                                                <option value="82">12000m or 32000ft (82)</option>
                                                <option value="83">13500m or 33000ft (83)</option>
                                                <option value="84">15000m or 34000ft (84)</option>
                                                <option value="85">16500m or 35000ft (85)</option>
                                                <option value="86">18000m or 36000ft (86)</option>
                                                <option value="87">19500m or 37000ft (87)</option>
                                                <option value="88">21000m or 38000ft (88)</option>
                                                <option value="89">Greater than 21000m or 38000ft (89)</option>
                                                <option value="90">Less than 50m or 150ft (90)</option>
                                                <option value="91">50 to 100m or 300ft (91)</option>
                                                <option value="92">100 to 200m or 600ft (92)</option>
                                                <option value="93">200 to 300m or 900ft (93)</option>
                                                <option value="94">300 to 600m or 1800ft (94)</option>
                                                <option value="95">600 to 1000m or 3000ft (95)</option>
                                                <option value="96">1000 to 1500m or 4500ft (96)</option>
                                                <option value="97">1500 to 2000m or 6000ft (97)</option>
                                                <option value="98">2000 to 2500m or 7500ft (98)</option>
                                                <option value="99">2500m or 7500ft or more or no clouds (99)</option>
                                                <option value="">Observation not done (/)</option>
                                                </select>
        </div>

          <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="i_l_c_l_t_3">3rd Lowest Cloud Layer Type</label>
            <select class="select2" id="i_l_c_l_t_3" name="i_l_c_l_t_3">
        
                                                <option value="0">Cirrus-Ci (0)</option>
                                                <option value="1">Cirrocumulus-Cc (1)</option>
                                                <option value="2">Cirrostratus-Cs (2)</option>
                                                <option value="3">Altocumulus-Ac (3)</option>                                               
                                                <option value="4">Altostratus-As (4)</option>                                                
                                                <option value="5">Nimbostratus-Ns (5)</option>                                               
                                                <option value="6">Stratocumulus-Sc (6)</option>                                               
                                                <option value="7">Stratus-St (7)</option>
                                                <option value="9">Cumulonimbus-Cb (9)</option>
                                                
                                                <caption value="">Clouds not visible owing to darkness, fog, duststorm, sandstorm, or other analogous phenomena (/)</option>
                                                </select>
        </div>


        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="i_l_c_l_b_h_3">3rd Lowest Cloud Layer Base Height</label>
            <select class="select2" id="i_l_c_l_b_h_3" name="i_l_c_l_b_h_3">
            <option value="" disabled selected></option>
            <option value="01">30m or 100ft (01)</option>
                                                <option value="02">60m or 200ft (02)</option>
                                                <option value="03">90m or 300ft (03)</option>
                                                <option value="04">120m or 400ft (04)</option>
                                                <option value="05">150m or 500ft (05)</option>
                                                <option value="06">180m or 600ft (06)</option>
                                                <option value="07">210m or 700ft (07)</option>
                                                <option value="08">240m or 800ft (08)</option>
                                                <option value="09">270m or 900ft (09)</option>
                                                <option value="10">300m or 1000ft (10)</option>
                                                <option value="11">330m or 1100ft (11)</option>
                                                <option value="12">360m or 1200ft (12)</option>
                                                <option value="13">390m or 1300ft (13)</option>
                                                <option value="14">420m or 1400ft (14)</option>
                                                <option value="15">450m or 1500ft (15)</option>
                                                <option value="16">480m or 1600ft (16)</option>
                                                <option value="17">510m or 1700ft (17)</option>
                                                <option value="18">540m or 1800ft (18)</option>
                                                <option value="19">570m or 1900ft (19)</option>
                                                <option value="20">600m or 2000ft (20)</option>
                                                <option value="21">630m or 2100ft (21)</option>
                                                <option value="22">660m or 2200ft (22)</option>
                                                <option value="23">690m or 2300ft (23)</option>
                                                <option value="24">720m or 2400ft (24)</option>
                                                <option value="25">750m or 2500ft (25)</option>
                                                <option value="26">780m or 2600ft (26)</option>
                                                <option value="27">810m or 2700ft (27)</option>
                                                <option value="28">840m or 2800ft (28)</option>
                                                <option value="29">870m or 2900ft (29)</option>
                                                <option value="30">900m or 3000ft (30)</option>
                                                <option value="31">930m or 3100ft (31)</option>
                                                <option value="32">960m or 3200ft (32)</option>
                                                <option value="33">990m or 3300ft (33)</option>
                                                <option value="34">1020m or 3400ft (34)</option>
                                                <option value="35">1050m or 3500ft (35)</option>
                                                <option value="36">1080m or 3600ft (36)</option>
                                                <option value="37">1110m or 3700ft (37)</option>
                                                <option value="38">1140m or 3800ft (38)</option>
                                                <option value="39">1170m or 3900ft (39)</option>
                                                <option value="40">1200m or 4000ft (40)</option>
                                                <option value="41">1230m or 4100ft (41)</option>
                                                <option value="42">1260m or 4200ft (42)</option>
                                                <option value="43">1290m or 4300ft (43)</option>
                                                <option value="44">1320m or 4400ft (44)</option>
                                                <option value="45">1350m or 4500ft (45)</option>
                                                <option value="46">1380m or 4600ft (46)</option>
                                                <option value="47">1410m or 4700ft (47)</option>
                                                <option value="48">1440m or 4800ft (48)</option>
                                                <option value="49">1470m or 4900ft (49)</option>
                                                <option value="50">1500m or 5000ft (50)</option>
                                                <option value="56">1800m or 6000ft (56)</option>
                                                <option value="57">2100m or 7000ft (57)</option>
                                                <option value="58">2400m or 8000ft (58)</option>
                                                <option value="59">2700m or 9000ft (59)</option>
                                                <option value="60">3000m or 10000ft (60)</option>
                                                <option value="61">3300m or 11000ft (61)</option>
                                                <option value="62">3600m or 12000ft (62)</option>
                                                <option value="63">3900m or 13000ft (63)</option>
                                                <option value="64">4200m or 14000ft (64)</option>
                                                <option value="65">4500m or 15000ft (65)</option>
                                                <option value="66">4800m or 16000ft (66)</option>
                                                <option value="67">5100m or 17000ft (67)</option>
                                                <option value="68">5400m or 18000ft (68)</option>
                                                <option value="69">5700m or 19000ft (69)</option>
                                                <option value="70">6000m or 20000ft (70)</option>
                                                <option value="71">6300m or 21000ft (71)</option>
                                                <option value="72">6600m or 22000ft (72)</option>
                                                <option value="73">6900m or 23000ft (73)</option>
                                                <option value="74">7200m or 24000ft (74)</option>
                                                <option value="75">7500m or 25000ft (75)</option>
                                                <option value="76">7800m or 26000ft (76)</option>
                                                <option value="77">8100m or 27000ft (77)</option>
                                                <option value="78">8400m or 28000ft (78)</option>
                                                <option value="79">8700m or 29000ft (79)</option>
                                                <option value="80">9000m or 30000ft (80)</option>
                                                <option value="81">10500m or 31000ft (81)</option>
                                                <option value="82">12000m or 32000ft (82)</option>
                                                <option value="83">13500m or 33000ft (83)</option>
                                                <option value="84">15000m or 34000ft (84)</option>
                                                <option value="85">16500m or 35000ft (85)</option>
                                                <option value="86">18000m or 36000ft (86)</option>
                                                <option value="87">19500m or 37000ft (87)</option>
                                                <option value="88">21000m or 38000ft (88)</option>
                                                <option value="89">Greater than 21000m or 38000ft (89)</option>
                                                <option value="90">Less than 50m or 150ft (90)</option>
                                                <option value="91">50 to 100m or 300ft (91)</option>
                                                <option value="92">100 to 200m or 600ft (92)</option>
                                                <option value="93">200 to 300m or 900ft (93)</option>
                                                <option value="94">300 to 600m or 1800ft (94)</option>
                                                <option value="95">600 to 1000m or 3000ft (95)</option>
                                                <option value="96">1000 to 1500m or 4500ft (96)</option>
                                                <option value="97">1500 to 2000m or 6000ft (97)</option>
                                                <option value="98">2000 to 2500m or 7500ft (98)</option>
                                                <option value="99">2500m or 7500ft or more or no clouds (99)</option>
                                                <option value="">Observation not done (/)</option>
                                                </select>
        </div>
      

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="i_l_c_l_t_4">4th Lowest Cloud Layer Type</label>
            <select class="select2" id="i_l_c_l_t_4" name="i_l_c_l_t_4">
            <option value="" disabled selected></option>
                                                <option value="0">Cirrus-Ci (0)</option>
                                                <option value="1">Cirrocumulus-Cc (1)</option>
                                                <option value="2">Cirrostratus-Cs (2)</option>                                            
                                                <option value="3">Altocumulus-Ac (3)</option>                                            
                                                <option value="4">Altostratus-As (4)</option>                                            
                                                <option value="5">Nimbostratus-Ns (5)</option>                                            
                                                <option value="6">Stratocumulus-Sc (6)</option>                                            
                                                <option value="7">Stratus-St (7)</option>                                            
                                                <option value="8">Cumulus-Cu (8)</option>                                            
                                                <option value="9">Cumulonimbus-Cb (9)</option>                                            
                                                <option value="">Clouds not visible owing to darkness, fog, duststorm, sandstorm, or other analogous phenomena (/)</option>
                                                </select>
        </div>



        
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label for="i_l_c_l_b_h_4">4th Lowest Cloud Layer Base Height</label>
            <select class="select2" id="i_l_c_l_b_h_4" name="i_l_c_l_b_h_4">
            <option value="" disabled selected></option>
            <option value="01">30m or 100ft (01)</option>
                    <option value="02">60m or 200ft (02)</option>
                    <option value="03">90m or 300ft (03)</option>
                    <option value="04">120m or 400ft (04)</option>
                    <option value="05">150m or 500ft (05)</option>
                    <option value="06">180m or 600ft (06)</option>
                    <option value="07">210m or 700ft (07)</option>
                    <option value="08">240m or 800ft (08)</option>
                    <option value="09">270m or 900ft (09)</option>
                    <option value="10">300m or 1000ft (10)</option>
                    <option value="11">330m or 1100ft (11)</option>
                    <option value="12">360m or 1200ft (12)</option>
                    <option value="13">390m or 1300ft (13)</option>
                    <option value="14">420m or 1400ft (14)</option>
                    <option value="15">450m or 1500ft (15)</option>
                    <option value="16">480m or 1600ft (16)</option>
                    <option value="17">510m or 1700ft (17)</option>
                    <option value="18">540m or 1800ft (18)</option>
                    <option value="19">570m or 1900ft (19)</option>
                    <option value="20">600m or 2000ft (20)</option>
                    <option value="21">630m or 2100ft (21)</option>
                    <option value="22">660m or 2200ft (22)</option>
                    <option value="23">690m or 2300ft (23)</option>
                    <option value="24">720m or 2400ft (24)</option>
                    <option value="25">750m or 2500ft (25)</option>
                    <option value="26">780m or 2600ft (26)</option>
                    <option value="27">810m or 2700ft (27)</option>
                    <option value="28">840m or 2800ft (28)</option>
                    <option value="29">870m or 2900ft (29)</option>
                    <option value="30">900m or 3000ft (30)</option>
                    <option value="31">930m or 3100ft (31)</option>
                    <option value="32">960m or 3200ft (32)</option>
                    <option value="33">990m or 3300ft (33)</option>
                    <option value="34">1020m or 3400ft (34)</option>
                    <option value="35">1050m or 3500ft (35)</option>
                    <option value="36">1080m or 3600ft (36)</option>
                    <option value="37">1110m or 3700ft (37)</option>
                    <option value="38">1140m or 3800ft (38)</option>
                    <option value="39">1170m or 3900ft (39)</option>
                    <option value="40">1200m or 4000ft (40)</option>
                    <option value="41">1230m or 4100ft (41)</option>
                    <option value="42">1260m or 4200ft (42)</option>
                    <option value="43">1290m or 4300ft (43)</option>
                    <option value="44">1320m or 4400ft (44)</option>
                    <option value="45">1350m or 4500ft (45)</option>
                    <option value="46">1380m or 4600ft (46)</option>
                    <option value="47">1410m or 4700ft (47)</option>
                    <option value="48">1440m or 4800ft (48)</option>
                    <option value="49">1470m or 4900ft (49)</option>
                    <option value="50">1500m or 5000ft (50)</option>
                    <option value="56">1800m or 6000ft (56)</option>
                    <option value="57">2100m or 7000ft (57)</option>
                    <option value="58">2400m or 8000ft (58)</option>
                    <option value="59">2700m or 9000ft (59)</option>
                    <option value="60">3000m or 10000ft (60)</option>
                    <option value="61">3300m or 11000ft (61)</option>
                    <option value="62">3600m or 12000ft (62)</option>
                    <option value="63">3900m or 13000ft (63)</option>
                    <option value="64">4200m or 14000ft (64)</option>
                    <option value="65">4500m or 15000ft (65)</option>
                    <option value="66">4800m or 16000ft (66)</option>
                    <option value="67">5100m or 17000ft (67)</option>
                    <option value="68">5400m or 18000ft (68)</option>
                    <option value="69">5700m or 19000ft (69)</option>
                    <option value="70">6000m or 20000ft (70)</option>
                    <option value="71">6300m or 21000ft (71)</option>
                    <option value="72">6600m or 22000ft (72)</option>
                    <option value="73">6900m or 23000ft (73)</option>
                    <option value="74">7200m or 24000ft (74)</option>
                    <option value="75">7500m or 25000ft (75)</option>
                    <option value="76">7800m or 26000ft (76)</option>
                    <option value="77">8100m or 27000ft (77)</option>
                    <option value="78">8400m or 28000ft (78)</option>
                    <option value="79">8700m or 29000ft (79)</option>
                    <option value="80">9000m or 30000ft (80)</option>
                    <option value="81">10500m or 31000ft (81)</option>
                    <option value="82">12000m or 32000ft (82)</option>
                    <option value="83">13500m or 33000ft (83)</option>
                    <option value="84">15000m or 34000ft (84)</option>
                    <option value="85">16500m or 35000ft (85)</option>
                    <option value="86">18000m or 36000ft (86)</option>
                    <option value="87">19500m or 37000ft (87)</option>
                    <option value="88">21000m or 38000ft (88)</option>
                    <option value="89">Greater than 21000m or 38000ft (89)</option>
                    <option value="90">Less than 50m or 150ft (90)</option>
                    <option value="91">50 to 100m or 300ft (91)</option>
                    <option value="92">100 to 200m or 600ft (92)</option>
                    <option value="93">200 to 300m or 900ft (93)</option>
                    <option value="94">300 to 600m or 1800ft (94)</option>
                    <option value="95">600 to 1000m or 3000ft (95)</option>
                    <option value="96">1000 to 1500m or 4500ft (96)</option>
                    <option value="97">1500 to 2000m or 6000ft (97)</option>
                    <option value="98">2000 to 2500m or 7500ft (98)</option>
                    <option value="99">2500m or 7500ft or more or no clouds (99)</option>
                    <option value="">Observation not done (/)</option>
                    </select>
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

</html>