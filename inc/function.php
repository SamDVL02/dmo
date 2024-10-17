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
    if (password_verify($password, $data['password_hash'])) {
      return $data;
    } else {
      return null;
    }
  } else {
    return null;
  }
}


function Confirm_Login()
{
if (isset($_SESSION["userid"])) {
  return true;
}  else {
  $_SESSION["ErrorMessage"]="Login Required !";
  Redirect_to("login.php");
}

}