<?php
require("../../db/connect.php");
session_start();

$email= !empty($_POST["email"]) ? trim($_POST["email"]) : '';
$pass= !empty($_POST["pass"]) ? trim($_POST["pass"]) : '';
$errors=[];

if($email==''){
       $errors["email"]="Email kiritish shart ";
}

else{
    $sql="SELECT * FROM users WHERE email LIKE :email  ";
    $stmt=$conn->prepare($sql);

    $stmt->execute([
       ":email"=>$email
    ]);
       
       $admin=$stmt->fetch();

       if($admin==false){
    $error["admin"]="Bunday foydalanuvchi yo'q";
   }else{

     if(hash('md5',$pass)==$admin["password"]){
            $_SESSION["user_id"]=$admin["id"];
            header("Location:../index.php");
     }else{
        $error["password_error"]="Parol xato!";
     }
   }
}
if($pass=''){
       $errors["pass"]="Parol kiritish shart ";
}
if(count($errors)>0){
    $_SESSION["errors"]=$error;
    header("Location:login.php");
}
?>