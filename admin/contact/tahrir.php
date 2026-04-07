<?php 
require("../../db/connect.php");
$id=$_POST["id"];
$name=$_POST["name"];
$email=$_POST["email"];
$mavzu=$_POST["mavzu"];
$xabar=$_POST["xabar"];
try{
  $sql="UPDATE contact SET name=:name, email=:email, mavzu=:mavzu, xabaringiz=:xabar WHERE id=:id";
$stmt=$conn->prepare($sql);
$stmt->execute([
    ':name'=>$name,
    ':email'=>$email,
    ':mavzu'=>$mavzu,
    ':xabar'=>$xabar,
    ':id'=>$id,
])  ;
echo "Malumotlar tahrirlandi";
}
catch(PDOException $e) {
  echo "Error: " . $sql . "<br>" . $e->getMessage();
}

?>