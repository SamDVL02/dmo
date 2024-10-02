<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $longitude = $_POST['long'];
    $latitude = $_POST['lat'];
    $geo_latitude = $_POST['geo_lat'];
    $geo_longitude = $_POST['geo_long'];
    $district = $_POST['district'];
    $year = $_POST['year'];
    $crop_type = $_POST['crop_type'];
    $field_number = $_POST['field_number'];
    $crop = $_POST['crop'];
    $variety = $_POST['variety'];
    $observation_date = date('Y-m-d', strtotime($_POST['YY']));
    $phenological_phase = $_POST['pheno_phase'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $leaf_area = $_POST['P_in'];
    $station =$_SESSION['station'];

    // SQL to insert form data into the database using PDO
    $sql = "INSERT INTO agriculture_data (
        longitude, latitude, geo_latitude, geo_longitude, district, 
        year, crop_type, field_number, crop, variety, observation_date, 
        phenological_phase, length, width, height, leaf_area, station
    ) VALUES (
        :longitude, :latitude, :geo_latitude, :geo_longitude, :district, 
        :year, :crop_type, :field_number, :crop, :variety, :observation_date, 
        :phenological_phase, :length, :width, :height, :leaf_area, :station
    )";

    try {
        $stmt = $conn->prepare($sql);
         $result = $stmt->execute([
            ':longitude' => $longitude,
            ':latitude' => $latitude,
            ':geo_latitude' => $geo_latitude,
            ':geo_longitude' => $geo_longitude,
            ':district' => $district,
            ':year' => $year,
            ':crop_type' => $crop_type,
            ':field_number' => $field_number,
            ':crop' => $crop,
            ':variety' => $variety,
            ':observation_date' => $observation_date,
            ':phenological_phase' => $phenological_phase,
            ':length' => $length,
            ':width' => $width,
            ':height' => $height,
            ':leaf_area' => $leaf_area,
            ':station' => $station
        ]);

        // Execute the query

        if ($result) {
            // Store success message in session
            $_SESSION["SuccessMessage"] = "User added successfully";

            // Redirect to the specified page
            header("Location: ../view_agro1.php");
            exit(); // Make sure to call exit() after header redirect to stop the script execution
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; // Display error message for debugging
    }
}
?>
