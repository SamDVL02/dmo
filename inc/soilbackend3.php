<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

        $sql = "INSERT INTO soil_sampling 
                    (sampling_date, crop_type, crop_variety,field_number, userid)
                    VALUES (:sampling_date, :crop_type, :crop_variety, :field_number, :userid)";

        $stmt = $conn->prepare($sql);

        try {
            $stmt->bindParam(':sampling_date', date('Y-m-d', strtotime($_POST['YY'])));
            $stmt->bindParam(':crop_type', $_POST['crop_type']);
            $stmt->bindParam(':crop_variety', $_POST['crop_variety']);
            $stmt->bindParam(':field_number', $_POST['field_number']);
            $stmt->bindParam(':userid', $_SESSION['userid']);

            $result = $stmt->execute();


            if ($result) {
                $_SESSION["SuccessMessage"] = "Soil Data added successfully";
                header("Location: ../view_soil_temp3.php");
                exit();
            } else 
            {
                echo "<div class='alert alert-danger'>Oops! Something went wrong with the database query.</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }


}
?>