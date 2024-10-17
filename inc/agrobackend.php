<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['YY'];
    $max_temp = $_POST['MT'];
    $min_temp = $_POST['mt'];
    $rainfall = $_POST['r'];
    $soil_temp = $_POST['st'];
    $userid = $_SESSION['userid'];

    
    $sql = "INSERT INTO agro_meteorological_data (date, max_temperature, min_temperature, rainfall, soil_temperature, userid)
                VALUES (:date, :max_temp, :min_temp, :rainfall, :soil_temp, :userid)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':max_temp', $max_temp);
        $stmt->bindParam(':min_temp', $min_temp);
        $stmt->bindParam(':rainfall', $rainfall);
        $stmt->bindParam(':soil_temp', $soil_temp);
        $stmt->bindParam(':userid', $userid);
        $result = $stmt->execute();

        if ($result) {

            $_SESSION["SuccessMessage"] = "User added successfully";
            header("Location: ../view_agro.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>
