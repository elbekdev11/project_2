<?php 
require("../../db/connect.php");
session_start();
$u_id=$_SESSION["user_id"];
$sql="SELECT password FROM users WHERE id=$u_id ";
$stmt=$conn->prepare($sql);
$stmt->execute();
$pass=$stmt->fetch();
$u_id=$_SESSION["user_id"];
$old_pass=!empty($_POST["old_pass"]) ? trim($_POST["old_pass"]): "";
$new_pass=!empty($_POST["new_pass"]) ? trim($_POST["new_pass"]): "";
$confirm_pass=!empty($_POST["confirm_pass"]) ? trim($_POST["confirm_pass"]): "";

if($old_pass=="" && $new_pass=="" && $confirm_pass==""){
  $_SESSION["settings_err"]="Malumotlar To'ldirilmagan";
    header("Location:index.php");

}

else{
$hash_old_pass=md5($old_pass);
if($hash_old_pass==$pass["password"] && strlen($new_pass)>=8){
  $hash_new_pass=md5($new_pass);
  $sql="UPDATE users SET password=:password";
  $stmt=$conn->prepare($sql); 
  $stmt->execute([
    ':password'=>$hash_new_pass
  ]);
      $_SESSION["pass_success"]="Parol tahrirlandi";
                 header("Location:index.php");
}
else{
 $_SESSION["pass_err"]="Malumotlar to'g'ri kiritilamdi";
                 header("Location:index.php");
}

}


if(strlen($new_pass)<8){
  $_SESSION["pass_err"]="Paro'l 8 ta belgidan iborat bo'lishi kerak";
            header("Location:index.php");
}
?>