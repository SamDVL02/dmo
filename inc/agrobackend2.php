<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $crop_type = $_POST['crop_type'];
    $field_number = $_POST['field_number'];
    $crops = $_POST['crops'];
    $variety = $_POST['variety'];
    $no_trees = $_POST['no_trees'];
    $no_bushes = $_POST['no_bushes'];
    $planting_date = date('Y-m-d', strtotime($_POST['YY1']));
    $observation_date = date('Y-m-d', strtotime($_POST['YY']));
    $growth_crop = $_POST['growth_crop'];
    $specify_other = $_POST['specify'];
    $plant_height = $_POST['plant_h'];
    $fruit_diameter = $_POST['fruit'];
    $canopy_diameter = $_POST['cann'];
    $tree_diameter = $_POST['tree'];
    $weed_infestation = $_POST['weed'];
    $pest_disease = $_POST['indc_disease'];
    $other_observations = $_POST['ob'];
    $userid = $_SESSION['userid'];

    $sql = "INSERT INTO crop_data (
        crop_type, field_number, crops, variety, no_trees, no_bushes, planting_date, observation_date, 
        growth_crop, specify_other, plant_height, fruit_diameter, canopy_diameter, tree_diameter, 
        weed_infestation, pest_disease, other_observations, userid
    ) VALUES (
        :crop_type, :field_number, :crops, :variety, :no_trees, :no_bushes, :planting_date, :observation_date, 
        :growth_crop, :specify_other, :plant_height, :fruit_diameter, :canopy_diameter, :tree_diameter, 
        :weed_infestation, :pest_disease, :other_observations, :userid
    )";
    

    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':crop_type', $crop_type);
        $stmt->bindParam(':field_number', $field_number);
        $stmt->bindParam(':crops', $crops);
        $stmt->bindParam(':variety', $variety);
        $stmt->bindParam(':no_trees', $no_trees, PDO::PARAM_INT);
        $stmt->bindParam(':no_bushes', $no_bushes, PDO::PARAM_INT);
        $stmt->bindParam(':planting_date', $planting_date);
        $stmt->bindParam(':observation_date', $observation_date);
        $stmt->bindParam(':growth_crop', $growth_crop);
        $stmt->bindParam(':specify_other', $specify_other);
        $stmt->bindParam(':plant_height', $plant_height);
        $stmt->bindParam(':fruit_diameter', $fruit_diameter);
        $stmt->bindParam(':canopy_diameter', $canopy_diameter);
        $stmt->bindParam(':tree_diameter', $tree_diameter);
        $stmt->bindParam(':weed_infestation', $weed_infestation);
        $stmt->bindParam(':pest_disease', $pest_disease, PDO::PARAM_INT);
        $stmt->bindParam(':other_observations', $other_observations);
        $stmt->bindParam(':userid', $userid);
        $result = $stmt->execute();
        if ($result) {
          
            $_SESSION["SuccessMessage"] = "Data added successfully";

            // Redirect to the specified page
            header("Location: ../view_agro2.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; // Display error message for debugging
    }
}
?>
