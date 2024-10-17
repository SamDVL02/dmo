<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO agri_observations
            (obs_agri, pheno_phase, gen_ass, density_sowing_area,
            density_area, p_h, damage_name, damage_date, damage_kind,
            damage_extent, pest_disease_name, pest_disease_date, pest_disease_kind, 
            pest_disease_extent, s_s, date_hav, yield, userid) 
            VALUES 
            (:obs_agri, :pheno_phase, :gen_ass, :density_sowing_area,
            :density_area, :p_h, :damage_name, :damage_date, :damage_kind, 
            :damage_extent, :pest_disease_name, :pest_disease_date, :pest_disease_kind, 
            :pest_disease_extent, :s_s, :date_hav, :yield, :userid)";
        $stmt = $conn->prepare($sql);
    try {
        $stmt->bindParam(':obs_agri', $_POST['obs_agri']);
        $stmt->bindParam(':pheno_phase', $_POST['pheno_phase']);
        $stmt->bindParam(':gen_ass', $_POST['gen_ass']);
        $stmt->bindParam(':density_sowing_area', $_POST['density_sowing_area']);
        $stmt->bindParam(':density_area', $_POST['density_area']);
        $stmt->bindParam(':p_h', $_POST['p_h']);
        $stmt->bindParam(':damage_name', $_POST['damage_name']);
        $stmt->bindParam(':damage_date', $_POST['damage_date']);
        $stmt->bindParam(':damage_kind', $_POST['damage_kind']);
        $stmt->bindParam(':damage_extent', $_POST['damage_extent']);
        $stmt->bindParam(':pest_disease_name', $_POST['pest_disease_name']);
        $stmt->bindParam(':pest_disease_date', $_POST['pest_disease_date']);
        $stmt->bindParam(':pest_disease_kind', $_POST['pest_disease_kind']);
        $stmt->bindParam(':pest_disease_extent', $_POST['pest_disease_extent']);
        $stmt->bindParam(':s_s', $_POST['s_s']);
        $stmt->bindParam(':date_hav', $_POST['date_hav']);
        $stmt->bindParam(':yield', $_POST['yield']);
        $stmt->bindParam(':userid', $_SESSION['userid']);

        $result = $stmt->execute();
        if ($result) {
            $_SESSION["SuccessMessage"] = "User added successfully";

            header("Location: ../view_dekad.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>
