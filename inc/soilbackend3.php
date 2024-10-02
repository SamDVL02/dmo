<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // SQL to insert form data into the database using PDO
    $sql = "INSERT INTO soil_sampling 
                (longitude, latitude, geo_lat, geo_long, district, sampling_date, crop_type, crop_variety, observer_name, station)
                VALUES (:longitude, :latitude, :geo_lat, :geo_long, :district, :sampling_date, :crop_type, :crop_variety, :observer_name, :station)";
                

    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':longitude', $_POST['long']);
        $stmt->bindParam(':latitude', $_POST['lat']);
        $stmt->bindParam(':geo_lat', $_POST['long']);
        $stmt->bindParam(':geo_long', $_POST['lat']);
        $stmt->bindParam(':district', $_POST['district']);
        $stmt->bindParam(':sampling_date', date('Y-m-d', strtotime($_POST['YY'])));
        $stmt->bindParam(':crop_type', $_POST['crop_type']);
        $stmt->bindParam(':crop_variety', $_POST['crop_variety']);
        $stmt->bindParam(':observer_name', $_POST['obs_name']);
        $stmt->bindParam(':station', $_POST['station']);

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