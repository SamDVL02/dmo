<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // SQL to insert form data into the database using PDO
    $sql = "INSERT INTO soil_observations 
                (longitude, latitude, geo_lat, geo_long, station_reg, month_of_observation, year, crop_type, observer_name, 
                 observation_date, surface_temp, temp_5cm, temp_10cm, temp_20cm, temp_30cm, temp_100cm, signature, station)
                VALUES (:longitude, :latitude, :geo_lat, :geo_long, :station_reg, :month_of_observation, :year, :crop_type, :observer_name, 
                        :observation_date, :surface_temp, :temp_5cm, :temp_10cm, :temp_20cm, :temp_30cm, :temp_100cm, :signature, :station)";
                

    $stmt = $conn->prepare($sql);

    try {
 $stmt->bindParam(':geo_lat', $_POST['geo_lat']);
 $stmt->bindParam(':longitude', $_POST['long']);
 $stmt->bindParam(':latitude', $_POST['lat']);
 $stmt->bindParam(':geo_lat', $_POST['geo_lat']);
 $stmt->bindParam(':geo_long', $_POST['geo_long']);
 $stmt->bindParam(':station_reg', $_POST['station_reg']);
 $stmt->bindParam(':month_of_observation', $_POST['month']);
 $stmt->bindParam(':year', $_POST['YYYY1']);
 $stmt->bindParam(':crop_type', $_POST['crop_type']);
 $stmt->bindParam(':observer_name', $_POST['obs_name']);
 $stmt->bindParam(':observation_date', date('Y-m-d', strtotime($_POST['YY'])));
 $stmt->bindParam(':surface_temp', $_POST['s_temp']);
 $stmt->bindParam(':temp_5cm', $_POST['5_temp']);
 $stmt->bindParam(':temp_10cm', $_POST['10_temp']);
 $stmt->bindParam(':temp_20cm', $_POST['20_temp']);
 $stmt->bindParam(':temp_30cm', $_POST['30_temp']);
 $stmt->bindParam(':temp_100cm', $_POST['100_temp']);
 $stmt->bindParam(':signature', $_POST['sign']);
 $stmt->bindParam(':station', $_SESSION['station']);
        $result = $stmt->execute();
        if ($result) {
            // Store success message in session
            $_SESSION["SuccessMessage"] = "Soil Data added successfully";

            // Redirect to the specified page
            header("Location: ../view_soil_temp2.php");
            exit(); // Make sure to call exit() after header redirect to stop the script execution
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; // Display error message for debugging
    }
}
?>