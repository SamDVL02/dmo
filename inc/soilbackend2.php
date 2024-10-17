<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    $sql = "INSERT INTO soil_observations 
                (crop_type, observation_date, surface_temp, temp_5cm, temp_10cm, temp_20cm, temp_30cm, temp_50cm, temp_100cm, userid)
                VALUES ( :crop_type, :observation_date, :surface_temp, :temp_5cm, :temp_10cm, :temp_20cm, :temp_30cm, :temp_50cm, :temp_100cm, :userid)";
    
    $stmt = $conn->prepare($sql);
    
    try {
        // Create a variable for the observation date to avoid passing a direct expression
        $observation_date = date('Y-m-d', strtotime($_POST['YY']));
        
        // Binding parameters
        $stmt->bindParam(':crop_type', $_POST['crop_type']);
        $stmt->bindParam(':observation_date', $observation_date); // Use the variable here
        $stmt->bindParam(':surface_temp', $_POST['s_temp']);
        $stmt->bindParam(':temp_5cm', $_POST['5_temp']);
        $stmt->bindParam(':temp_10cm', $_POST['10_temp']);
        $stmt->bindParam(':temp_20cm', $_POST['20_temp']);
        $stmt->bindParam(':temp_30cm', $_POST['30_temp']);
        $stmt->bindParam(':temp_50cm', $_POST['50_temp']); // Fixed missing colon
        $stmt->bindParam(':temp_100cm', $_POST['100_temp']);
        $stmt->bindParam(':userid', $_SESSION['userid']);
        
        // Execute the statement
        $result = $stmt->execute();
        
        if ($result) {
            $_SESSION["SuccessMessage"] = "Soil Data added successfully";
            header("Location: ../view_soil_temp2.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>
