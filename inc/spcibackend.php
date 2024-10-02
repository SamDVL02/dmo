<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $time_of_observation = $_POST['t_o_o'];
    $wind_direction = $_POST['w_d'];
    $wind_speed = $_POST['w_s'];
    $visibility = $_POST['visib'];
    $present_weather = $_POST['p_w'];
    $total_sky_cloud_cover = $_POST['tscc'];
    $first_significant_cloud_oktas = $_POST['sco1'];
    $first_significant_cloud_height = $_POST['sch1'];
    $second_significant_cloud_oktas = $_POST['sco2'];
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
    $clp = $_POST['c_l_p'];
    $wet_bulb_temperature = $_POST['w_b_t'];
    $trend = $_POST['trend'];
    $remarks = $_POST['remarks'];
    $user_id = $_SESSION['userid'];

    $sql = "INSERT INTO speci (
        time_of_observation,
        wind_direction,
        wind_speed,
        visibility,
        present_weather,
        total_sky_cloud_cover,
        first_significant_cloud_oktas,
        first_significant_cloud_height,
        second_significant_cloud_oktas,
        second_significant_cloud_height,
        second_individual_cloud_layer_type,
        third_significant_cloud_oktas,
        third_significant_cloud_height,
        fourth_significant_cloud_oktas,
        fourth_significant_cloud_height,
        dry_bulb_temperature,
        dew_point_temperature,
        qnh_h,
        qnh_w,
        clp,
        wet_bulb_temperature,
        trend,
        remarks,
        user_id
    ) VALUES (
        :time_of_observation,
        :wind_direction,
        :wind_speed,
        :visibility,
        :present_weather,
        :total_sky_cloud_cover,
        :first_significant_cloud_oktas,
        :first_significant_cloud_height,
        :second_significant_cloud_oktas,
        :second_significant_cloud_height,
        :second_individual_cloud_layer_type,
        :third_significant_cloud_oktas,
        :third_significant_cloud_height,
        :fourth_significant_cloud_oktas,
        :fourth_significant_cloud_height,
        :dry_bulb_temperature,
        :dew_point_temperature,
        :qnh_h,
        :qnh_w,
        :clp,
        :wet_bulb_temperature,
        :trend,
        :remarks,
        :user_id
    )";


    
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    throw new Exception('Failed to prepare SQL statement: ' . implode(' ', $pdo->errorInfo()));
}
    try {
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
    $stmt->bindParam(':dew_point_temperature', $dew_point_temperature);
    $stmt->bindParam(':qnh_h', $qnh_h);
    $stmt->bindParam(':qnh_w', $qnh_w);
    $stmt->bindParam(':clp', $clp);
    $stmt->bindParam(':wet_bulb_temperature', $wet_bulb_temperature);
    $stmt->bindParam(':trend', $trend);
    $stmt->bindParam(':remarks', $remarks);
    $stmt->bindParam(':user_id', $user_id);

    $result = $stmt->execute();
        if ($result) {
         
            $_SESSION["SuccessMessage"] = "User added successfully";

           
            header("Location: ../all-speci.php");
            exit(); 
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; 
}
}
?>