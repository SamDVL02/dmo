
<?php
require_once("inc/db.php"); 
require_once("inc/session.php");

if(isset($_GET["id"])){
  $id = $_GET["id"];
  global $conn;
  $sql = "DELETE FROM `metar`  WHERE id='$id'";
  $execute = $conn->query($sql);
  if ($execute) {
    $_SESSION["SuccessMessage"]="Metar data Deleted Successfully ! ";
 header("location:view_metar_data.php");
    // code...
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
 header("location:view_metar_data.php");
  }
}
?>