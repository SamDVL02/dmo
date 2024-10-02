<?php require_once("inc/db.php"); ?>
<?php require_once("inc/session.php"); ?>
<?php
if(isset($_GET["id"])){
  $id = $_GET["id"];
  global $conn;
  $sql = "DELETE FROM `station`  WHERE id='$id'";
  $execute = $conn->query($sql);
  if ($execute) {
    $_SESSION["SuccessMessage"]="Station Deleted Successfully ! ";
 header("location:view.php");
    // code...
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
 header("location:view.php");
  }
}
?>
