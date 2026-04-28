<?php 

$server="localhost";
$user="root";
$password="";
$db="portfol_db";

try{
$conn = new PDO("mysql:host=$server;dbname=$db",$user,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
}
catch(PDOException $e){
    echo "Ulanishda xatolik" ;
}

?>