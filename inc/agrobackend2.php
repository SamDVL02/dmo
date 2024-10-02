<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

// Ensure session is started


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // SQL to insert form data into the database using PDO
    $sql = "INSERT INTO field_data (
        longitude, latitude, geo_lat, geo_long, district, year, crop_type, field_number, crop, variety, 
        no_trees, no_bushes, planting_date, observation_date, growth_crop, specify_other, 
        plant_height, fruit_diameter, canopy_diameter, tree_diameter, weed_infestation, 
        pest_disease, other_observations,station
    ) VALUES (
        :longitude, :latitude, :geo_lat, :geo_long, :district, :year, :crop_type, :field_number, :crop, :variety, 
        :no_trees, :no_bushes, :planting_date, :observation_date, :growth_crop, :specify_other, 
        :plant_height, :fruit_diameter, :canopy_diameter, :tree_diameter, :weed_infestation, 
        :pest_disease, :other_observations, :station
    )";

    $stmt = $conn->prepare($sql);

    try {
        $stmt->bindParam(':longitude', $_POST['long'], PDO::PARAM_STR);
        $stmt->bindParam(':latitude', $_POST['lat'], PDO::PARAM_STR);
        $stmt->bindParam(':geo_lat', $_POST['geo_lat'], PDO::PARAM_STR);
        $stmt->bindParam(':geo_long', $_POST['geo_long'], PDO::PARAM_STR);
        $stmt->bindParam(':district', $_POST['district'], PDO::PARAM_STR);
        $stmt->bindParam(':year', $_POST['YYYY1'], PDO::PARAM_INT);
        $stmt->bindParam(':crop_type', $_POST['crop_type'], PDO::PARAM_STR);
        $stmt->bindParam(':field_number', $_POST['field_number'], PDO::PARAM_STR);
        $stmt->bindParam(':crop', $_POST['crops'], PDO::PARAM_STR);
        $stmt->bindParam(':variety', $_POST['variety'], PDO::PARAM_STR);
        $stmt->bindParam(':no_trees', $_POST['no_trees'], PDO::PARAM_INT);
        $stmt->bindParam(':no_bushes', $_POST['no_bushes'], PDO::PARAM_INT);
        $stmt->bindParam(':planting_date', $_POST['YY1'], PDO::PARAM_STR);  // Assuming date is in Y-m-d format
        $stmt->bindParam(':observation_date', $_POST['YY'], PDO::PARAM_STR);  // Assuming date is in Y-m-d format
        $stmt->bindParam(':growth_crop', $_POST['growth_crop'], PDO::PARAM_STR);
        $stmt->bindParam(':specify_other', $_POST['specify'], PDO::PARAM_STR);
        $stmt->bindParam(':plant_height', $_POST['plant_h'], PDO::PARAM_STR);
        $stmt->bindParam(':fruit_diameter', $_POST['fruit'], PDO::PARAM_STR);
        $stmt->bindParam(':canopy_diameter', $_POST['cann'], PDO::PARAM_STR);
        $stmt->bindParam(':tree_diameter', $_POST['tree'], PDO::PARAM_STR);
        $stmt->bindParam(':weed_infestation', $_POST['weed'], PDO::PARAM_STR);
        $stmt->bindParam(':pest_disease', $_POST['indc_disease'], PDO::PARAM_INT);
        $stmt->bindParam(':other_observations', $_POST['ob'], PDO::PARAM_STR);
        $stmt->bindParam(':station', $_SESSION['station'], PDO::PARAM_STR);
        // Execute the query
        $result = $stmt->execute();
        if ($result) {
            // Store success message in session
            $_SESSION["SuccessMessage"] = "User added successfully";

            // Redirect to the specified page
            header("Location: ../view_agro2.php");
            exit(); // Make sure to call exit() after header redirect to stop the script execution
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>"; // Display error message for debugging
    }
}
?>
