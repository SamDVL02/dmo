<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO severe_data_events 
    (event_date, month, year, time_obs, event_time, event_type, village, ward, district, region, damage, name, identification, station) 
    VALUES 
    (:event_date, :month, :year, :time_obs, :event_time, :event_type, :village, :ward, :district, :region, :damage, :name, :identification, :station)");

    try {
    $stmt->bindParam(':event_date', $_POST['date']);
    $stmt->bindParam(':month', $_POST['month']);
    $stmt->bindParam(':year', $_POST['YYYY1']);
    $stmt->bindParam(':time_obs', $_POST['Time_obs']);
    $stmt->bindParam(':event_time', $_POST['Barometer']);
    $stmt->bindParam(':event_type', $_POST['Barometer']);
    $stmt->bindParam(':village', $_POST['VV']);
    $stmt->bindParam(':ward', $_POST['Pa_ww']);
    $stmt->bindParam(':district', $_POST['Pa_ww']);
    $stmt->bindParam(':region', $_POST['ddd']);
    $stmt->bindParam(':damage', $_POST['ff']);
    $stmt->bindParam(':name', $_POST['REMMS']);
    $stmt->bindParam(':identification', $_POST['REMMS']);
    $stmt->bindParam(':station', $_SESSION['station']);

    // Execute the statement
    $result= $stmt->execute();

        

        if ($result) {
            // Store success message in session
            $_SESSION["SuccessMessage"] = "Data added successfully";

            // Redirect to the specified page
            header("Location: ../view_severe.php");
            exit(); // Make sure to call exit() after header redirect to stop the script execution
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; // Display error message for debugging
    }
}
?>
