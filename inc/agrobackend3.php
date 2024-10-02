<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // SQL to insert form data into the database using PDO
    $sql = "INSERT INTO agro3 
    (geo_lat, geo_long, district, year, crop_type, crop, observation_date, signature, station)
    VALUES (:geo_lat, :geo_long, :district, :year, :crop_type, :crop, :observation_date, :signature, :station)";

    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':geo_lat', $_POST['geo_lat']);
        $stmt->bindParam(':geo_long', $_POST['geo_long']);
        $stmt->bindParam(':district', $_POST['district']);
        $stmt->bindParam(':year', $_POST['YYYY1']);
        $stmt->bindParam(':crop_type', $_POST['crop_type']);
        $stmt->bindParam(':crop', $_POST['crop']);
        $stmt->bindParam(':observation_date', date('Y-m-d', strtotime($_POST['YY'])));
        $stmt->bindParam(':signature', $_POST['sign']);
        $stmt->bindParam(':station', $_SESSION['station']);
        // Execute the query
        $result = $stmt->execute();
        if ($result) {
            // Store success message in session
            $_SESSION["SuccessMessage"] = "User added successfully";

            // Redirect to the specified page
            header("Location: ../view_agro3.php");
            exit(); // Make sure to call exit() after header redirect to stop the script execution
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; // Display error message for debugging
    }
}
?>
