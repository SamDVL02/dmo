<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $surface_temp = $_POST['surface_temp'];
    $userid = $_SESSION['userid'];
    $sql = "INSERT INTO soil_data (surface_temp, userid) VALUES (:surface_temp, :userid)";

    $stmt = $conn->prepare($sql);

    try {
       $stmt->bindParam(':surface_temp', $surface_temp, PDO::PARAM_STR);
       $stmt->bindParam(':userid', $userid);
        $result = $stmt->execute();
        if ($result) {
            $_SESSION["SuccessMessage"] = "Soil Data added successfully";

            header("Location: ../view_soil_temp.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; // Display error message for debugging
    }
}
?>
