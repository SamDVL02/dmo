<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // SQL to insert form data into the database using PDO
    $sql = "INSERT INTO dackend (
                longitude, latitude, geo_latitude, geo_longitude, district_name, observer_name, year,
                crop_type, obs_agri, pheno_phase, general_assessment, density_sowing_area, density_area,
                plant_height, damage_adv_date, pest_disease_damage_percent, weed_spread_marks, harvest_date, signature, station
            ) VALUES (
                :longitude, :latitude, :geo_latitude, :geo_longitude, :district_name, :observer_name, :year,
                :crop_type, :obs_agri, :pheno_phase, :general_assessment, :density_sowing_area, :density_area,
                :plant_height, :damage_adv_date, :pest_disease_damage_percent, :weed_spread_marks, :harvest_date, :signature, :station
            )";

      $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':longitude', $_POST['long']);
        $stmt->bindParam(':latitude', $_POST['lat']);
        $stmt->bindParam(':geo_latitude', $_POST['geo_lat']);
        $stmt->bindParam(':geo_longitude', $_POST['geo_long']);
        $stmt->bindParam(':district_name', $_POST['district_name']);
        $stmt->bindParam(':observer_name', $_POST['obs_name']);
        $stmt->bindParam(':year', $_POST['YYYY1']);
        $stmt->bindParam(':crop_type', $_POST['crop_type']);
        $stmt->bindParam(':obs_agri', $_POST['obs_agri']);
        $stmt->bindParam(':pheno_phase', $_POST['pheno_phase']);
        $stmt->bindParam(':general_assessment', $_POST['gen_ass']);
        $stmt->bindParam(':density_sowing_area', $_POST['density_sowing_area']);
        $stmt->bindParam(':density_area', $_POST['density_area']);
        $stmt->bindParam(':plant_height', $_POST['p_h']);
        $stmt->bindParam(':damage_adv_date', $_POST['Damage_adv']);
        $stmt->bindParam(':pest_disease_damage_percent', $_POST['pest_disease_per']);
        $stmt->bindParam(':weed_spread_marks', $_POST['s_s']);
        $stmt->bindParam(':harvest_date', $_POST['date_hav']);
        $stmt->bindParam(':signature', $_POST['sign']);
        $stmt->bindParam(':station', $_SESSION['station']);
        // Execute the query
        $result = $stmt->execute();
        if ($result) {
            // Store success message in session
            $_SESSION["SuccessMessage"] = "User added successfully";

            // Redirect to the specified page
            header("Location: ../view_dekad.php");
            exit(); // Make sure to call exit() after header redirect to stop the script execution
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; // Display error message for debugging
    }
}
?>
