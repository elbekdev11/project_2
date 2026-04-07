<?php
require("../../db/connect.php");
$id=$_POST["id"];


try{
 $sql="DELETE FROM  contact   WHERE id=:id";
$stmt=$conn->prepare($sql);
$stmt->execute([
    ':id'=>$id,
])  ;
 echo "Malumot o'chirildi";
}
catch(PDOException $e){
echo "Error: " . $sql . "<br>" . $e->getMessage();
}
?>