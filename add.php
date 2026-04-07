<?php 
session_start();
require("db/connect.php");

$name=!empty($_POST["name"]) ? trim($_POST["name"]): '';
$email=!empty($_POST["email"]) ? trim($_POST["email"]): '';
$mavzu=!empty($_POST["mavzu"]) ? trim($_POST["mavzu"]): '';
$xabar=!empty($_POST["xabar"]) ? trim($_POST["xabar"]): '';
$errors=[];
if($name==''){
      $errors["name"]="Ismni kiritish majburiy";
}
if($email==''){
      $errors["email"]="Emailni kiritish majburiy";
}
if($mavzu==''){
      $errors["mavzu"]="Mavzuni kiritish majburiy";
}
if(!empty($_SESSION["success"])){
$_SESSION["$errors"]=$errors;
}

try{
 $sql="INSERT INTO contact (name,email,mavzu,xabaringiz)
 VALUES (:name,:email,:mavzu,:xabaringiz)";
 $stmt=$conn->prepare($sql);
 $stmt->execute([
    ':name'=>$name,
    ':email'=>$email,
    ':mavzu'=>$mavzu,
    ':xabaringiz'=>$xabar
 ]);
 echo "Malumot yozildi";
} catch(PDOException $e) {
  echo "Error: " . $sql . "<br>" . $e->getMessage();
}
?>