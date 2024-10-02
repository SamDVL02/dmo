<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // SQL to insert form data into the database using PDO
    $sql = "INSERT INTO soil_data 
    (geo_lat, geo_long, district, surface_temp, signature, station)
    VALUES (:geo_lat, :geo_long, :district, :surface_temp, :signature, :station)";

    $stmt = $conn->prepare($sql);

    try {
 $stmt->bindParam(':geo_lat', $_POST['geo_lat']);
        $stmt->bindParam(':geo_long', $_POST['geo_long']);
        $stmt->bindParam(':district', $_POST['district']);
        $stmt->bindParam(':surface_temp', $_POST['surface_temp']);
        $stmt->bindParam(':signature', $_POST['sign']);
        $stmt->bindParam(':station', $_SESSION['station']);
        $result = $stmt->execute();
        if ($result) {
            // Store success message in session
            $_SESSION["SuccessMessage"] = "Soil Data added successfully";

            // Redirect to the specified page
            header("Location: ../view_soil_temp.php");
            exit(); // Make sure to call exit() after header redirect to stop the script execution
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; // Display error message for debugging
    }
}
?>
