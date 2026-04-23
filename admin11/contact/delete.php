<?php
require("../../db/connect.php");
$id=$_POST["id"];


try{
 $sql="DELETE FROM  contact   WHERE id=:id";
$stmt=$conn->prepare($sql);
$stmt->execute([
    ':id'=>$id,
])  ;
$_SESSION["success"]="Malumotlar O'chirildi";
    header("Location:index.php");
}
catch(PDOException $e){
echo "Error: " . $sql . "<br>" . $e->getMessage();
}
?>