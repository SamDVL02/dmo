<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO severe_data_events 
    (time_obs, event_type, damage, userid) 
    VALUES 
    (:time_obs, :event_type, :damage, :userid)");

    try {
    $stmt->bindParam(':time_obs', $_POST['Time_obs']);
    $stmt->bindParam(':event_type', $_POST['Barometer']);
    $stmt->bindParam(':damage', $_POST['ff']);
    $stmt->bindParam(':userid', $_SESSION['userid']);
    $result= $stmt->execute();

        if ($result) {
            $_SESSION["SuccessMessage"] = "Data added successfully";
            header("Location: ../view_severe.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; 
    }
}
?>
