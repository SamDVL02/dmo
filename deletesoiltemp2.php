<?php require_once("inc/db.php"); ?>
<?php require_once("inc/session.php"); ?>
<?php
if(isset($_GET["id"])){
  $id = $_GET["id"];
  global $conn;
  $sql = "DELETE FROM `soil_observations`  WHERE id='$id'";
  $Execute = $conn->query($sql);
  if ($Execute) {
    $_SESSION["SuccessMessage"]="Country Deleted Successfully ! ";
 header("location: view_soil_temp2.php");
    // code...
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
 header("location: view_soil_temp2.php");
  }
}
?>