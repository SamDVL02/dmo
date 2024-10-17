<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crop_type = $_POST['crop_type'];
    $observation_date = $_POST['YY'];
    $userid = $_SESSION["userid"];
    $observation_date = DateTime::createFromFormat('d/m/Y', $observation_date)->format('Y-m-d');
    $sql = "INSERT INTO agro_data (crop_type, observation_date, userid) VALUES (:crop_type, :observation_date, :userid)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':crop_type', $crop_type);
        $stmt->bindParam(':observation_date', $observation_date);
        $stmt->bindParam(':userid', $userid);
        $result = $stmt->execute();
        if ($result) {
           
            $_SESSION["SuccessMessage"] = "Data added successfully";

            
            header("Location: ../view_agro3.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>
