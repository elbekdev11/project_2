<?php 
require("../../db/connect.php");

$name=$_POST["name"];
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

?>