<?php 
require("../../db/connect.php");

session_start();

$name= !empty($_POST["name"]) ? trim($_POST["name"]) : '';  
$email= !empty($_POST["email"]) ? trim($_POST["email"]) : ''; 
$pass= !empty($_POST["pass"]) ? trim($_POST["pass"]) : ''; 
$confirm_pass= !empty($_POST["confirm_pass"]) ? trim($_POST["confirm_pass"]) : ''; 

$errors=[];

if($name==''){
    $errors["$name"]="Ismni yozish shart";
}
if($email==''){
    $errors["$email"]="Emailni yozish shart";
}
if($pass==''){
    $errors["$pass"]="Paswordni yozish shart";
}
if($confirm_pass==''){
    $errors["$confirm_pass"]="Takroriy paswordni yozish shart";
}
if(strlen($pass)<=7){
    $errors["$pass_length"]="Pasword 8 ta harfdan iborat bo'lishi kerak";
}
if($pass!== $confirm_pass){
    $errors["parol"]="parol va qayta parol bir xil emas";
}
if(count($errors)>0){
    $_SESSION["errors"]=$errors;
    header("Location:register.php");

}
else{
    try{
        $sql="INSERT INTO users(name,email,password) VALUES(:name, :email, :password)";
        $stmt=$conn->prepare($sql);
        $stmt->execute([
            ":name"=>$name,
            ":email"=>$email,
            ":password"=>hash('md5',$pass)
        ]);
        header("Location:login.php");
}
catch(PDOException $e){
        echo $e->getMessage();
}
}
?>