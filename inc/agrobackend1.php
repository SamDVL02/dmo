<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crop_type = $_POST['crop_type'];
    $field_number = $_POST['field_number'];
    $crop = $_POST['crop'];
    $variety = $_POST['variety'];
    $observation_date = $_POST['YY'];
    $pheno_phase = $_POST['pheno_phase'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $leaf_area = $_POST['P_in'];
    $userid = $_SESSION['userid'];
    $observation_date = date('Y-m-d', strtotime(str_replace('/', '-', $observation_date)));


    $sql = "INSERT INTO crop_observations (crop_type, field_number, crop, variety, observation_date, phenological_phase, length, width, height, leaf_area, userid)
            VALUES (:crop_type, :field_number, :crop, :variety, :observation_date, :pheno_phase, :length, :width, :height, :leaf_area, :userid)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':crop_type', $crop_type);
        $stmt->bindParam(':field_number', $field_number);
        $stmt->bindParam(':crop', $crop);
        $stmt->bindParam(':variety', $variety);
        $stmt->bindParam(':observation_date', $observation_date);
        $stmt->bindParam(':pheno_phase', $pheno_phase);
        $stmt->bindParam(':length', $length);
        $stmt->bindParam(':width', $width);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':leaf_area', $leaf_area);
        $stmt->bindParam(':userid', $userid);
        $result = $stmt->execute();
        if ($result) {
            $_SESSION["SuccessMessage"] = "Data added successfully";
            header("Location: ../view_agro1.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>
