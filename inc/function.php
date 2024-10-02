<?php
require_once 'db.php';

function Redirect_to($New_Location){
  header("Location:".$New_Location);
  exit;
}
function CheckUserNameExistsOrNot($username)
{
  global $conn;
  $sql    = "SELECT first_name FROM users WHERE first_name=:first_name";
  $stmt   = $conn->prepare($sql);
  $stmt->bindValue(':first_name',$username);
  $_SESSION['username']=$username;
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return true;
  }else {
    return false;
  }
}
function Login_Attempt($email, $password){
  global $conn;
  $sql = "SELECT * FROM users WHERE email= :email LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':email', $email);
  $stmt->execute();
  $data = $stmt->fetch();
  
  if ($data) {
    // Use password_verify to check the password
    if (password_verify($password, $data['password_hash'])) {
      return $data;
    } else {
      return null;
    }
  } else {
    return null;
  }
}

function Confirm_Login(){
if (isset($_SESSION["userid"])) {
  return true;
}  else {
  $_SESSION["ErrorMessage"]="Login Required !";
  Redirect_to("login.php");
}
}
// $sql = "SELECT COUNT(*) FROM users";
//   $stmt = $conn->query($sql);
//   $TotalRows= $stmt->fetch();
//   $TotalUsers=array_shift($TotalRows);
//   $TotalUsers;
// //total Customer

// $sql = "SELECT COUNT(*) FROM customer";
//   $stmt = $conn->query($sql);
//   $TotalRows= $stmt->fetch();
//   $totalcustomer=array_shift($TotalRows);
//  $totalcustomer;


//  $sql = "SELECT COUNT(*) FROM data";
//   $stmt = $conn->query($sql);
//   $TotalRows= $stmt->fetch();
//   $totaldata=array_shift($TotalRows);
//  $totaldata;


//   $sql = "SELECT SUM(total) as total   FROM data";
//   $stmt = $conn->query($sql);
//   $TotalRows= $stmt->fetch();
//   $total=array_shift($TotalRows);
//  $total;