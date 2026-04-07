<?php 

$server="localhost";
$user="root";
$password="";
$db="portfoli_db";

try{
$conn = new PDO("mysql:host=$server;dbname=$db",$user,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Ulanishda xatolik" ;
}

?>