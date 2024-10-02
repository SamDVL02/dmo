
<?php
require_once("inc/db.php"); 
require_once("inc/session.php");
if(isset($_GET["id"])){
  $id = $_GET["id"];
  global $conn;
  $sql = "DELETE FROM `speci`  WHERE id='$id'";
  $Execute = $conn->query($sql);
  if ($Execute) {
    $_SESSION["SuccessMessage"]="Speci data Deleted Successfully ! ";
 header("location:all-speci.php");
    // code...
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
 header("location:all-speci.php");
  }
}
?>