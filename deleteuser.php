<?php require_once("inc/db.php"); ?>
<?php require_once("inc/session.php"); ?>
<?php
if(isset($_GET["id"])){
  $id = $_GET["id"];
  global $conn;
  $sql = "DELETE FROM `users`  WHERE id='$id'";
  $Execute = $conn->query($sql);
  if ($Execute) {
    $_SESSION["SuccessMessage"]="User  Deleted Successfully ! ";
 header("location:all-users.php");
    // code...
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
 header("location:all-users.php");
  }
}
?>