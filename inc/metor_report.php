<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // SQL to insert form data into the database using PDO
    $sql = "INSERT INTO metar (
        time_of_observation, wind_direction, wind_speed, visibility,
        present_weather, total_sky_cloud_cover, first_significant_cloud_oktas,
        first_significant_cloud_height, second_significant_cloud_oktas,
        second_significant_cloud_height, second_individual_cloud_layer_type,
        third_significant_cloud_oktas, third_significant_cloud_height,
        fourth_significant_cloud_oktas, fourth_significant_cloud_height,
        dry_bulb_temperature, wet_bulb_temperature, g_reset, g_read, dew_point_temperature,
        max_temperature, min_temperature, qnh_hpa, qnh_whole, c_l_p, mslp,
        gpm, vapor_pressure, relative_humidity, wind_run,
        total_precipitation_24h, trend, remarks, user_id
    ) VALUES (
        :time_of_observation, :wind_direction, :wind_speed, :visibility,
        :present_weather, :total_sky_cloud_cover, :first_significant_cloud_oktas,
        :first_significant_cloud_height, :second_significant_cloud_oktas,
        :second_significant_cloud_height, :second_individual_cloud_layer_type,
        :third_significant_cloud_oktas, :third_significant_cloud_height,
        :fourth_significant_cloud_oktas, :fourth_significant_cloud_height,
        :dry_bulb_temperature, :wet_bulb_temperature, :g_reset, :g_read, :dew_point_temperature,
        :max_temperature, :min_temperature, :qnh_hpa, :qnh_whole, :c_l_p, :mslp,
        :gpm, :vapor_pressure, :relative_humidity, :wind_run,
        :total_precipitation_24h, :trend, :remarks, :user_id
    )";

    try {
        $stmt = $conn->prepare($sql);

        function getPostValue($key) {
            return isset($_POST[$key]) && $_POST[$key] !== '' ? $_POST[$key] : null;
        }
        
        $time_of_observation = getPostValue('time_of_observation');
        $wind_direction = getPostValue('wind_direction');
        $wind_speed = getPostValue('wind_speed');
        $visibility = getPostValue('visibility');
        $present_weather = getPostValue('present_weather');
        $total_sky_cloud_cover = getPostValue('tscc');
        $first_significant_cloud_oktas = getPostValue('sco1');
        $first_significant_cloud_height = getPostValue('sch1');
        $second_significant_cloud_oktas = getPostValue('sco2');
        $second_significant_cloud_height = getPostValue('sch2');
        $second_individual_cloud_layer_type = getPostValue('iclt2');
        $third_significant_cloud_oktas = getPostValue('sco3');
        $third_significant_cloud_height = getPostValue('sch3');
        $fourth_significant_cloud_oktas = getPostValue('sco4');
        $fourth_significant_cloud_height = getPostValue('sch4');
        $dry_bulb_temperature = getPostValue('d_b_t');
        $wet_bulb_temperature = getPostValue('w_b_t');
        $g_reset = getPostValue('g_b_re_v');
        $g_read = getPostValue('g_b_r_v');
        $dew_point_temperature = getPostValue('d_p_t');
        $max_temperature = getPostValue('ma_t');
        $min_temperature = getPostValue('mi_t');
        $qnh_hpa = getPostValue('qnh_h');
        $qnh_whole = getPostValue('qnh_w');
        $c_l_p = getPostValue('c_l_p');
        $mslp = getPostValue('mslp');
        $gpm = getPostValue('gpm');
        $vapor_pressure = getPostValue('v_t');
        $relative_humidity = getPostValue('r_h');
        $wind_run = getPostValue('w_r');
        $total_precipitation_24h = getPostValue('t_p_a_a_24');
        $trend = getPostValue('trend');
        $remarks = getPostValue('remarks');
        $userId = $_SESSION['userid']; 
        
        $stmt->bindParam(':time_of_observation', $time_of_observation);
        $stmt->bindParam(':wind_direction', $wind_direction);
        $stmt->bindParam(':wind_speed', $wind_speed);
        $stmt->bindParam(':visibility', $visibility);
        $stmt->bindParam(':present_weather', $present_weather);
        $stmt->bindParam(':total_sky_cloud_cover', $total_sky_cloud_cover);
        $stmt->bindParam(':first_significant_cloud_oktas', $first_significant_cloud_oktas);
        $stmt->bindParam(':first_significant_cloud_height', $first_significant_cloud_height);
        $stmt->bindParam(':second_significant_cloud_oktas', $second_significant_cloud_oktas);
        $stmt->bindParam(':second_significant_cloud_height', $second_significant_cloud_height);
        $stmt->bindParam(':second_individual_cloud_layer_type', $second_individual_cloud_layer_type);
        $stmt->bindParam(':third_significant_cloud_oktas', $third_significant_cloud_oktas);
        $stmt->bindParam(':third_significant_cloud_height', $third_significant_cloud_height);
        $stmt->bindParam(':fourth_significant_cloud_oktas', $fourth_significant_cloud_oktas);
        $stmt->bindParam(':fourth_significant_cloud_height', $fourth_significant_cloud_height);
        $stmt->bindParam(':dry_bulb_temperature', $dry_bulb_temperature);
        $stmt->bindParam(':wet_bulb_temperature', $wet_bulb_temperature);
        $stmt->bindParam(':g_reset', $g_reset);
        $stmt->bindParam(':g_read', $g_read);
        $stmt->bindParam(':dew_point_temperature', $dew_point_temperature);
        $stmt->bindParam(':max_temperature', $max_temperature);
        $stmt->bindParam(':min_temperature', $min_temperature);
        $stmt->bindParam(':qnh_hpa', $qnh_hpa);
        $stmt->bindParam(':qnh_whole', $qnh_whole);
        $stmt->bindParam(':c_l_p', $c_l_p);
        $stmt->bindParam(':mslp', $mslp);
        $stmt->bindParam(':gpm', $gpm);
        $stmt->bindParam(':vapor_pressure', $vapor_pressure);
        $stmt->bindParam(':relative_humidity', $relative_humidity);
        $stmt->bindParam(':wind_run', $wind_run);
        $stmt->bindParam(':total_precipitation_24h', $total_precipitation_24h);
        $stmt->bindParam(':trend', $trend);
        $stmt->bindParam(':remarks', $remarks);
        $stmt->bindParam(':user_id', $userId);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION["SuccessMessage"] = "Metar data added successfully";

            $textContent = "Time of Observation: $time_of_observation\n"
                . "Wind Direction: $wind_direction\n"
                . "Wind Speed: $wind_speed\n"
                . "Visibility: $visibility\n"
                . "Present Weather: $present_weather\n"
                . "Remarks: $remarks\n";
                
            $textFileName = "metar_report_" . time() . ".txt";
            file_put_contents("../files/$textFileName", $textContent);

            $hisFileName = "weather_observation_" . time() . ".his";
            file_put_contents("../files/$hisFileName", $textContent);

            echo "<div class='alert alert-success'>Data added successfully. <a href='../files/$textFileName' download>Download Text File</a> | <a href='../files/$hisFileName' download>Download .HIS File</a></div>";
            Redirect_to("../view_metar_data.php");
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}
?>
