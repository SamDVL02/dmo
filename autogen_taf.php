<?php
include  'inc/session.php';
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
    <div id="wrapper" class="wrapper bg-ash">
        <?php include 'inc/navbar.php'  ?>
        <div class="dashboard-page-one">
            <?php include  'inc/sidebar.php'?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                    <h3> <?php echo $_SESSION['station'] ?> TAF </h3>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Record TAF</h3>
                                    </div>
                                </div>
                                <form class="new-added-form" method="POST" action="inc/autogen_taf_bac.php">
                                    <div class="row">

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="taf_type">SELECT TAF</label>
                                            <select id="taf_type" class="select2" name="taf_type" required>
                                                <option value="">Please Select*</option>
                                                <option value="TAF">TAF</option>
                                                <option value="TAF-AMD">TAF AMD</option>
                                                <option value="TAF COR">TAF COR</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="taf_date">Date of TAF Issuance *</label>
                                            <input type="text" id="taf_date" name="taf_date" placeholder="dd/mm/yyyy"
                                                class="form-control air-datepicker" data-position='bottom right'
                                                required>
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="month">Monthly</label>
                                            <select id="month" class="select2" name="month" required>
                                                <option value="">Please Select*</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="taf_time">TAF Issuance Time (UTC) *</label>
                                            <select id="taf_time" class="select2" name="taf_time" required>
                                                <option value="">Please Select *</option>
                                                <option></option>
                                                <option value="00">00</option>
                                                <option value="0030">0030</option>
                                                <option value="01">01</option>
                                                <option value="0130">0130</option>
                                                <option value="02">02</option>
                                                <option value="0230">0230</option>
                                                <option value="03">03</option>
                                                <option value="0330">0330</option>
                                                <option value="04">04</option>
                                                <option value="0430">0430</option>
                                                <option value="05">05</option>
                                                <option value="0530">0530</option>
                                                <option value="06">06</option>
                                                <option value="0630">0630</option>
                                                <option value="07">07</option>
                                                <option value="0730">0730</option>
                                                <option value="08">08</option>
                                                <option value="0830">0830</option>
                                                <option value="09">09</option>
                                                <option value="0930">0930</option>
                                                <option value="10">10</option>
                                                <option value="1030">1030</option>
                                                <option value="11">11</option>
                                                <option value="1130">1130</option>
                                                <option value="12">12</option>
                                                <option value="1230">1230</option>
                                                <option value="13">13</option>
                                                <option value="1330">1330</option>
                                                <option value="14">14</option>
                                                <option value="1430">1430</option>
                                                <option value="15">15</option>
                                                <option value="1530">1530</option>
                                                <option value="16">16</option>
                                                <option value="1630">1630</option>
                                                <option value="17">17</option>
                                                <option value="1730">1730</option>
                                                <option value="18">18</option>
                                                <option value="1830">1830</option>
                                                <option value="19">19</option>
                                                <option value="1930">1930</option>
                                                <option value="20">20</option>
                                                <option value="2030">2030</option>
                                                <option value="21">21</option>
                                                <option value="2130">2130</option>
                                                <option value="22">22</option>
                                                <option value="2230">2230</option>
                                                <option value="23">23</option>
                                                <option value="2330">2330</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="taf_services">IF NO TAF SERVICES USE THIS SECTION</label>
                                            <select id="taf_services" class="select2" name="taf_services" required>
                                                <option value="">Please Select *</option>
                                                <option value="NIL">NIL</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="taf_validity_begin_date">TAF VALIDITY BEGINNING DATE:*</label>
                                            <input type="number" id="taf_validity_begin_date"
                                                name="taf_validity_begin_date" placeholder="" class="form-control"
                                                required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="taf_validity_begin_time">TAF VALIDITY BEGINNING TIME
                                                (UTC):*</label>
                                            <input type="number" id="taf_validity_begin_time"
                                                name="taf_validity_begin_time" placeholder="" class="form-control"
                                                required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="taf_validity_end_date">TAF VALIDITY ENDING DATE:*</label>
                                            <input type="number" id="taf_validity_end_date" name="taf_validity_end_date"
                                                placeholder="" class="form-control" required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="taf_validity_end_time">TAF VALIDITY ENDING TIME (UTC):*</label>
                                            <input type="number" id="taf_validity_end_time" name="taf_validity_end_time"
                                                placeholder="" class="form-control" required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="taf_cancellation">TAF CANCELLATION:</label>
                                            <input type="text" id="taf_cancellation" name="taf_cancellation"
                                                placeholder="" class="form-control">
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind_direction">Enter wind direction (3 digits):</label>
                                            <input type="text" id="wind_direction" name="wind_direction" placeholder=""
                                                class="form-control" required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind_speed_2">Enter wind speed (kts) 2 digits:</label>
                                            <input type="text" id="wind_speed_2" name="wind_speed_2" placeholder=""
                                                class="form-control" required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="wind_speed_1">Enter wind speed (kts) 1 digit:</label>
                                            <input type="text" id="wind_speed_1" name="wind_speed_1" placeholder=""
                                                class="form-control" required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="visibility">Enter visibility if applicable in (m):</label>
                                            <input type="text" id="visibility" name="visibility" placeholder=""
                                                class="form-control" required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="weather_descriptor">Select Weather Descriptor:</label>
                                            <select id="weather_descriptor" class="select2" name="weather_descriptor"
                                                required>
                                                <option value="">Please Select*</option>
                                                <option value="1">Mathematics</option>
                                                <option value="2">English</option>
                                                <option value="3">Chemistry</option>
                                                <option value="4">Biology</option>
                                                <option value="5">Others</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="subject">Subject *</label>
                                            <select id="subject" class="select2" name="subject" required>
                                                <option value="BC">Patches (BC)</option>
                                                <option value="BL">Blowing (BL)</option>
                                                <option value="DR">Drifting (DR)</option>
                                                <option value="FZ">Freezing (FZ)</option>
                                                <option value="MI">Shallow (MI)</option>
                                                <option value="PR">Partial (PR)</option>
                                                <option value="SH">Showers (SH)</option>
                                                <option value="TS">Thunderstorm (TS)</option>
                                                <option value="VC">In the vicinity (VC)</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="weather_phenomenon">Select Weather Phenomenon</label>
                                            <select id="weather_phenomenon" class="select2" name="weather_phenomenon"
                                                required>
                                                <option value="Mist(BR)">Mist (BR)</option>
                                                <option value="Dust(DU)">Dust (DU)</option>
                                                <option value="Duststorm(DS)">Duststorm (DS)</option>
                                                <option value="Drizzle(DZ)">Drizzle (DZ)</option>
                                                <option value="Funnel cloud(FC)">Funnel cloud (FC)</option>
                                                <option value="Fog(FG)">Fog (FG)</option>
                                                <option value="Smoke(FU)">Smoke (FU)</option>
                                                <option value="Hail(GR)">Hail (GR)</option>
                                                <option value="Small hail/Snow pellets(GS)">Small hail/Snow pellets (GS)
                                                </option>
                                                <option value="Haze(HZ)">Haze (HZ)</option>
                                                <option value="Nil significant weather(NSW)">Nil significant weather
                                                    (NSW)</option>
                                                <option value="Ice Pellets(PL)">Ice Pellets (PL)</option>
                                                <option value="Dust devil(PO)">Dust devil (PO)</option>
                                                <option value="Rain(RA)">Rain (RA)</option>
                                                <option value="Sand(SA)">Sand (SA)</option>
                                                <option value="Snow grains(SG)">Snow grains (SG)</option>
                                                <option value="Snow(SN)">Snow (SN)</option>
                                                <option value="Squall(SQ)">Squall (SQ)</option>
                                                <option value="Sandstorm(SS)">Sandstorm (SS)</option>
                                                <option value="Volcanic ash(VA)">Volcanic ash (VA)</option>
                                                <option value="Unidentified precipitation(UP)">Unidentified
                                                    precipitation (UP)</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="weather_intensity">Select Weather Intensity</label>
                                            <select id="weather_intensity" class="select2" name="weather_intensity"
                                                required>
                                                <option value="Heavy">Heavy (+)</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="Light">Light (-)</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="cloud_layer_amount_1">Select 1st Individual lowest clouds layer
                                                amount (Oktas)</label>
                                            <select id="cloud_layer_amount_1" class="select2"
                                                name="cloud_layer_amount_1" required>
                                                <option value="">Please Select*</option>
                                                <option value="NSC">NSC</option>
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
                                            <label for="cloud_layer_type_1">Select 1st Individual lowest cloud layer
                                                Type only if CB or TCU is in first order by height:</label>
                                            <select id="cloud_layer_type_1" class="select2" name="cloud_layer_type_1"
                                                required>
                                                <option value="">Please Select*</option>
                                                <option value="NSC">NSC</option>
                                                <option value="CB">CB</option>
                                                <option value="TCU">TCU</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="cloud_height_1">Enter height of the first cloud type</label>
                                            <input type="text" id="cloud_height_1" name="cloud_height_1" placeholder=""
                                                class="form-control" required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="cloud_layer_amount_3">Select 3rd Individual lowest clouds layer
                                                amount (Oktas)</label>
                                            <select id="cloud_layer_amount_3" class="select2"
                                                name="cloud_layer_amount_3" required>
                                                <option value="NSC">NSC</option>
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
                                            <label for="cloud_layer_type_2">Section *</label>
                                            <select id="cloud_layer_type_2" class="select2" name="cloud_layer_type_2"
                                                required>
                                                <option value="">Select 3rd Individual lowest cloud layer Type only if
                                                    CB or TCU is in first order by height:</option>
                                                <option value="CB">CB</option>
                                                <option value="TCU">TCU</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="cloud_height_2">Enter height of the second cloud type:</label>
                                            <input type="text" id="cloud_height_2" name="cloud_height_2" placeholder=""
                                                class="form-control" required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="cloud_layer_amount_4">Section *</label>
                                            <select id="cloud_layer_amount_4" class="select2"
                                                name="cloud_layer_amount_4" required>
                                                <option value="">Select 4th Individual lowest clouds layer amount
                                                    (Oktas):</option>
                                                <option value="NSC">NSC</option>
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
                                            <label for="cloud_height_4">Enter height of the fourth cloud type:</label>
                                            <input type="text" id="cloud_height_4" name="cloud_height_4" placeholder=""
                                                class="form-control" required>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="cavok">Section *</label>
                                            <select id="cavok" class="select2" name="cavok" required>
                                                <option value="">Select CAVOK if Cloud, Visibility and Weather are OK:
                                                </option>
                                                <option value="CAVOK">CAVOK</option>
                                            </select>
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