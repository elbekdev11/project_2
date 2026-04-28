<?php 
require("../../db/connect.php");
session_start();

$u_id=$_SESSION["user_id"];
$name=!empty($_POST["name"]) ? trim($_POST["name"]): "";
$email=!empty($_POST["email"]) ? trim($_POST["email"]): "";
if($name=="" || $email==""){
  $_SESSION["settings_err"]="Malumotlar To'ldirilmagan";
    header("Location:index.php");

}

  $sql="UPDATE users SET name=:name, email=:email WHERE id=:id ";
$stmt=$conn->prepare($sql);
$stmt->execute([
   ':id'=>$u_id,
    ':name'=>$name,
    ':email'=>$email,
]); 
  $_SESSION["settings_success"]="Malumotlar Tahrirlandi";
    header("Location:index.php");


?>