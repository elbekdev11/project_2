<?php 
require("../../db/connect.php");

$email=$_POST["email"];
$pass=$_POST["password"];

if(){
try{

  $sql="UPDATE contact SET name=:name  ";
$stmt=$conn->prepare($sql);
$stmt->execute([
    ':name'=>$name,
  
])  ;
  $_SESSION["success"]="Malumotlar Tahrirlandi";
    header("Location:index.php");
}
catch(PDOException $e) {
  echo "Error: " . $sql . "<br>" . $e->getMessage();
}
}


?>