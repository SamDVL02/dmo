<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";
require_once '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Prepare INSERT statement
        $sql = "INSERT INTO synop (
            time_of_observation, wind_measuring_instruments, indicator_for_precipitation_data,
            station_operation_weather, height_of_lowest_cloud_base, visibility,
            precipitation_duration, present_weather, past_weather_1, past_weather_2,
            low_level_cloud_type, medium_level_cloud_type, high_level_cloud_type,
            grass_temperature, character_intensity_of_precipitation, hours_from_precipitation_to_observation,
            precipitation_amount, type_of_instrument_for_evaporation_measurement,
            sunshine_card_segments, cups_added_removed,
            first_lowest_cloud_layer_type, first_lowest_cloud_layer_base_height,
            second_lowest_cloud_layer_type, second_lowest_cloud_layer_base_height,
            third_lowest_cloud_layer_type, third_lowest_cloud_layer_base_height,
            fourth_lowest_cloud_layer_type, fourth_lowest_cloud_layer_base_height,
            wind_direction, wind_speed, t_s_c_c,
            f_s_c, s_s_c, t_s_c, fo_s_c, d_b_t, d_p_t, max_t,
            min_t, c_l_p, m_s_l_p, gpm, t_p_24, user_id
        ) VALUES (
            :time_of_observation, :wind_measuring_instruments, :indicator_for_precipitation_data,
            :station_operation_weather, :height_of_lowest_cloud_base, :visibility,
            :precipitation_duration, :present_weather, :past_weather_1, :past_weather_2,
            :low_level_cloud_type, :medium_level_cloud_type, :high_level_cloud_type,
            :grass_temperature, :character_intensity_of_precipitation, :hours_from_precipitation_to_observation,
            :precipitation_amount, :type_of_instrument_for_evaporation_measurement,
            :sunshine_card_segments, :cups_added_removed,
            :first_lowest_cloud_layer_type, :first_lowest_cloud_layer_base_height,
            :second_lowest_cloud_layer_type, :second_lowest_cloud_layer_base_height,
            :third_lowest_cloud_layer_type, :third_lowest_cloud_layer_base_height,
            :fourth_lowest_cloud_layer_type, :fourth_lowest_cloud_layer_base_height,
            :wind_direction, :wind_speed, :t_s_c_c,
            :f_s_c, :s_s_c, :t_s_c, :fo_s_c, :d_b_t, :d_p_t, :max_t,
            :min_t, :c_l_p, :m_s_l_p, :gpm, :t_p_24, :user_id
        )";

        $stmt = $conn->prepare($sql);
        
        // Function to safely get POST values
        function getPostValue($key) {
            return !empty($_POST[$key]) ? $_POST[$key] : null;
        }
        
        $time = getPostValue('t_o_o');
        // Fetch METAR data
        $sql1 = "SELECT * FROM metar WHERE time_of_observation = :time_of_observation";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute(['time_of_observation' => $time]);
        $data = $stmt1->fetch(PDO::FETCH_ASSOC);
        
        // Check if data is found
        if ($data) {
            $t_o_o = $data['time_of_observation'] ?? null;
            $wind_direction = $data['wind_direction'] ?? null;
            $wind_speed = $data['wind_speed'] ?? null;
            $t_S_C = $data['total_cloud_sky_cover'] ?? null;
            $f_s_C = $data['first_significant_cloud_oktas'] ?? null;
            $s_s_c = $data['second_significant_cloud_oktas'] ?? null;
            $t_S_c = $data['third_significant_cloud_oktas'] ?? null;
            $fo_s_c = $data['fourth_significant_cloud_oktas'] ?? null;
            $d_b_t = $data['dry_bulb_temperature'] ?? null;
            $d_p_t = $data['wet_bulb_temperature'] ?? null;
            $m_t = $data['max_temperature'] ?? null;
            $mi_t = $data['min_temperature'] ?? null;
            $c_l_p = $data['c_l_p'] ?? null;
            $m_s_l_p = $data['m_s_l_p'] ?? null;
            $g_p_m = $data['gpm'] ?? null;
            $t_p = $data['total_precipitation_24h'] ?? null;
        }

        // Bind parameters using bindParam
        $stmt->bindParam(':time_of_observation', $time);
        $stmt->bindParam(':wind_measuring_instruments', getPostValue('w_m_i_u'));
        $stmt->bindParam(':indicator_for_precipitation_data', getPostValue('i_f_i_o_p'));
        $stmt->bindParam(':station_operation_weather', getPostValue('type'));
        $stmt->bindParam(':height_of_lowest_cloud_base', getPostValue('height_above_s_b_l_c_s'));
        $stmt->bindParam(':visibility', getPostValue('visibility'));
        $stmt->bindParam(':precipitation_duration', getPostValue('p_d'));
        $stmt->bindParam(':present_weather', getPostValue('p_w'));
        $stmt->bindParam(':past_weather_1', getPostValue('pa_w1'));
        $stmt->bindParam(':past_weather_2', getPostValue('pa_w2'));
        $stmt->bindParam(':low_level_cloud_type', getPostValue('l_l_c_t'));
        $stmt->bindParam(':medium_level_cloud_type', getPostValue('m_l_c_t'));
        $stmt->bindParam(':high_level_cloud_type', getPostValue('h_l_c_t'));
        $stmt->bindParam(':grass_temperature', getPostValue('mi_t'));
        $stmt->bindParam(':character_intensity_of_precipitation', getPostValue('c_i_p'));
        $stmt->bindParam(':hours_from_precipitation_to_observation', getPostValue('n_h_b_e'));
        $stmt->bindParam(':precipitation_amount', getPostValue('p_a_f_3'));
        $stmt->bindParam(':type_of_instrument_for_evaporation_measurement', getPostValue('t_i_e_m'));
        $stmt->bindParam(':sunshine_card_segments', getPostValue('c_s_s_c'));
        $stmt->bindParam(':cups_added_removed', getPostValue('n_c_e'));
        $stmt->bindParam(':first_lowest_cloud_layer_type', getPostValue('i_l_c_l_t_1'));
        $stmt->bindParam(':first_lowest_cloud_layer_base_height', getPostValue('i_l_c_l_b_h_1'));
        $stmt->bindParam(':second_lowest_cloud_layer_type', getPostValue('i_l_c_l_t_2'));
        $stmt->bindParam(':second_lowest_cloud_layer_base_height', getPostValue('i_l_c_l_b_h_2'));
        $stmt->bindParam(':third_lowest_cloud_layer_type', getPostValue('i_l_c_l_t_3'));
        $stmt->bindParam(':third_lowest_cloud_layer_base_height', getPostValue('i_l_c_l_b_h_3'));
        $stmt->bindParam(':fourth_lowest_cloud_layer_type', getPostValue('i_l_c_l_t_4'));
        $stmt->bindParam(':fourth_lowest_cloud_layer_base_height', getPostValue('i_l_c_l_b_h_4'));
        $stmt->bindParam(':wind_direction', $wind_direction);
        $stmt->bindParam(':wind_speed', $wind_speed);
        $stmt->bindParam(':t_s_c_c', $t_S_C);
        $stmt->bindParam(':f_s_c', $f_s_C);
        $stmt->bindParam(':s_s_c', $s_s_c);
        $stmt->bindParam(':t_s_c', $t_S_c);
        $stmt->bindParam(':fo_s_c', $fo_s_c);
        $stmt->bindParam(':d_b_t', $d_b_t);
        $stmt->bindParam(':d_p_t', $d_p_t);
        $stmt->bindParam(':max_t', $m_t);
        $stmt->bindParam(':min_t', $mi_t);
        $stmt->bindParam(':c_l_p', $c_l_p);
        $stmt->bindParam(':m_s_l_p', $m_s_l_p);
        $stmt->bindParam(':gpm', $g_p_m);
        $stmt->bindParam(':t_p_24', $t_p);

        $userId = $_SESSION['userid'];
        $stmt->bindParam(':user_id', $userId);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION["SuccessMessage"] = "Synop added successfully";
            header("Location: ../view_synop_data.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>
