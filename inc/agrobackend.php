<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $long = $_POST['long'];
    $lat = $_POST['lat'];
    $geo_lat = $_POST['geo_lat']; // Fetching station from session
    $geo_long = $_POST['geo_long'];
    $district = $_POST['district'];
    $year = $_POST['year'];
    $obser_name = $_POST['on'];
    $max_temp = $_POST['MT'];
    $min_temp = $_POST['mt'];
    $rainfall = $_POST['r'];
    $soil_temp = $_POST['st'];
    $station = $_SESSION['station'];

    // SQL to insert form data into the database using PDO
    $sql = "INSERT INTO agro (longitude, latitude, geo_lat, geo_long, district, year, observe_name, max_temp, 
    min_temp, rainfall, soil_temp, station)
            VALUES (:long, :lat, :geo_lat, :geo_long, :district, :year, :observe_name, :max_temp, :min_temp, :rain, :sol_temp, :station)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':long', $long);
        $stmt->bindParam(':lat', $lat);
        // $stmt->bindParam(':station', $station); // Ensure station is being bound correctly
        $stmt->bindParam(':geo_lat', $geo_lat);
        $stmt->bindParam(':geo_long', $geo_long);
        $stmt->bindParam(':district', $district);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':observe_name', $obser_name);
        $stmt->bindParam(':max_temp', $max_temp);
        $stmt->bindParam(':min_temp', $min_temp);
        $stmt->bindParam(':rain', $rainfall);
        $stmt->bindParam(':sol_temp', $soil_temp);
        $stmt->bindParam(':station', $station);
        // Execute the query
        $result = $stmt->execute();

        if ($result) {
            // Store success message in session
            $_SESSION["SuccessMessage"] = "User added successfully";

            // Redirect to the specified page
            header("Location: ../view_agro.php");
            exit(); // Make sure to call exit() after header redirect to stop the script execution
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; // Display error message for debugging
    }
}
?>
