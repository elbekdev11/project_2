 <?php
 session_start();
if(empty($_SESSION["user_id"])){
  header("Location:auth/login.php");
}
 require("$link"."../db/connect.php");


$sql="SELECT COUNT(view) FROM contact  WHERE view=0 ";

$stmt=$conn->prepare($sql);
$stmt->execute();

$m_c=$stmt->fetch();
$soni=$m_c["COUNT(view)"];
 ?>
 
 
 
 <!doctype html> 
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Admin Panel</title>
  <meta name="description" content="Portfolio loyihalarini boshqarish uchun admin panel.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= $link?>assets/css/admin.css">
</head>
<body>
  <div class="admin-layout">
    <aside class="sidebar">
      <a href="#" class="brand">AE Admin</a>
      <nav class="menu">
        <a href="<?=$link?>index.php" class="menu-link <?php if ($page==="home"){ echo "active";}?> ">HOME</a>
        <a href="<?=$link?>contact/index.php" class="menu-link <?php if ($page==="message"){ echo "active";}?>">Message</a>
        <a href="<?=$link?>tahrirlash/index.php" class="menu-link <?php if ($page==="settings"){ echo "active";}?> ">Settings</a>
        <a href="<?=$link?>auth/logout.php" class="menu-link">LogOut -></a>
      </nav>
    </aside>

    <div class="content-wrap">
      <header class="topbar">
        <div>
          <h1 class="h4 mb-0">Portfolio Admin Panel</h1>
          <small class="text-secondary">Sayt kontentini shu yerdan boshqarishingiz mumkin</small>
        </div>
        <div class="d-flex align-items-center gap-2">
          <?php

          if($soni>0) : ?>
           <a href="<?=$link?>contact/index.php" class="btn btn-outline-light btn-sm btn-warning text-danger"><?=$soni?></a>
          <?php endif ?>
          <button class="btn btn-primary btn-sm">Saqlash</button>
        </div>
      </header>                                                                              