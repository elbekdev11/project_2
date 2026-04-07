<?php 
require("../../db/connect.php");
  $sql = "SELECT * FROM contact";
try{
    $stmt=$conn->prepare($sql);
 $stmt->execute();
 $contact=$stmt->fetchAll();
}
catch(PDOException $error){
echo $error->getMessage();
}
?>
<!doctype html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact CRUD - List</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/contact.css">
</head>
<body>
  <div class="page-wrap">
    <div class="panel mb-3">
      <div class="title-row">
        <div>
          <h1 class="h4 mb-1">Contact xabarlari</h1>
          <small class="text-secondary">CRUD dizayn - list ko'rinishi</small>
        </div>
        <a href="create.php" class="btn btn-primary btn-sm">+ Yangi xabar</a>
      </div>
      <div class="row g-2">
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Ism bo'yicha qidirish"></div>
        <div class="col-md-4"><input type="email" class="form-control" placeholder="Email bo'yicha qidirish"></div>
        <div class="col-md-4"><button class="btn btn-outline-light w-100">Filter</button></div>
      </div>
    </div>

    <div class="panel panel-soft">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
                <tr>
                  <th>#</th>
                  <th>Ismi</th>
                  <th>email</th>
                  <th>mavzu</th>
                  <th>Xabar</th>
                  <th>Amal</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($contact as $contact):?>
                <tr>
                  <td><?= $contact["id"]?></td>
                  <td><?= $contact["name"]?></td>
                  <td><?= $contact["email"]?></td>
                  <td><?= $contact["mavzu"]?></td>
                  <td><?= $contact["xabaringiz"]?></td>
                  <td>
                      <div style="display:flex">
                   
                      <form action="update.php" method="POST">
                        <input type="hidden" value="<?= $contact["id"]?>" name="id">
                          <input type="submit" style="background-color:yellow" value="Tahrirlash"  placeholder="O'chirish" >
                      </form>
                     <form action="delete.php" method="POST">
                      <input type="hidden" value="<?= $contact["id"]?>" name="id">
                         <input type="submit" style="background-color:red" value="O'chirish"   placeholder="O'chirish">
                     </form>
                   
                  
                  </div>
                  </td>
                 
                </tr>
            
                    <?php endforeach ?>
                
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
