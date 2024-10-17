
<?php
    require_once("inc/db.php"); 
    require_once("inc/session.php");
    if(isset($_GET["id"])){
      $id = $_GET["id"];
      global $conn;
      $sql = "DELETE FROM `agri_observations`  WHERE id='$id'";
      $Execute = $conn->query($sql);
      if ($Execute) {
        $_SESSION["SuccessMessage"]="Country Deleted Successfully ! ";
    header("location: view_dekad.php");
      }else {
        $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
    header("location: view_dekad.php");
      }
    }
?>