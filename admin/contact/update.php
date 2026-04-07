<?php

require("../../db/connect.php");

$id=$_POST["id"];

try{
    $sql="SELECT * FROM contact WHERE id=:id";
$stmt=$conn->prepare($sql);
$stmt->execute([
  ':id'=> $id
]);
$contact=$stmt->fetch();

}catch(PDOException $e){
    echo $e->getMessage();
}


?>


<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f4f4;
        }
        .form-box{
            width:400px;
            margin:50px auto;
            background:#fff;
            padding:25px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }
        input, textarea{
            width:100%;
            padding:10px;
            margin:10px 0;
            border:1px solid #ccc;
            border-radius:5px;
        }
        button{
            width:100%;
            padding:10px;
            background:#007bff;
            color:#fff;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }
        button:hover{
            background:#0056b3;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Biz bilan bog'lanish</h2>
    <form action="tahrir.php" method="POST">
          <input type="hidden" value="<?=$contact["id"]?>" name="id">  
      
        <input type="text" value="<?=$contact["name"]?>"  name="name" placeholder="Ismingiz" >
        
        <input type="email" value="<?=$contact["email"]?>" name="email" placeholder="Emailingiz">
        
        <input type="text" value="<?=$contact["mavzu"]?>" name="mavzu" placeholder="Mavzu" >
        
        <textarea name="xabar" value="<?=$contact["xabaringiz"]?>" placeholder="Xabaringiz" ></textarea>
        
        <button type="submit">Yuborish</button>
        
    </form>
</div>

</body>
</html>