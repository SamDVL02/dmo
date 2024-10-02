
<?php
require_once("inc/session.php"); 
require_once("inc/db.php");


if(isset($_GET["id"])){
  $id = $_GET["id"];
  global $conn;
  $sql = "DELETE FROM `synop`  WHERE id='$id'";
  $execute = $conn->query($sql);
  if ($execute) {
    $_SESSION["SuccessMessage"]="SYNOP Data  Deleted Successfully ! ";
 header("location:view_synop_data.php");
    // code...
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
 header("location:view_synop_data.php");
  }
}

