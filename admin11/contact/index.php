<?php 
$page="message";
 $link="../";
 include("../layouts/header.php");
require("../../db/connect.php");

  $sql = "SELECT * FROM contact ORDER BY id DESC";
try{
    $stmt=$conn->prepare($sql);
 $stmt->execute();

}
catch(PDOException $error){
echo $error->getMessage();

}
 $contact=$stmt->fetchAll();
?>
            <main class="main-content">
        

       
  <section class="card-box">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Mavjud loyihalar</h2>
            <input type="search" class="form-control form-control-sm table-search" placeholder="Qidirish...">
          </div>
          <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
           <thead>
                <tr>
                  <th>#</th>
                  <th>ISM</th>
                  <th>Email</th>
                  <th>Mavzu</th>
                   <th>Holat</th>
                  <th>Yangilangan sana</th>
                  <th>Amal</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i=0;
                foreach($contact as $contact):
                $i++
                ?>
                <tr>
                  <td><?= $i?></td>
                  <td><?= $contact["name"]?></td>
                  <td><?= $contact["email"]?></td>
                  <td><?= $contact["mavzu"]?></td>
                        <td><?php
                  $view=$contact["view"];
                  if($view==0){
                     echo '<span class="badge text-bg-warning">no views</span>';
                  }else{
                    echo '<span class="badge text-bg-info">seen</span>';
                  }
                  
                  ?></td>
                  <td><?php 
                   $sana=strtotime($contact["create_at"]);
                    echo date('y-m-d H:i',$sana);
                  ?></td>
                  <td>
                      <div style="display:flex">
                    
                     <a href="show.php?m_id=<?=$contact['id'] ?>" class="btn btn-sm btn-outline-info">view</a>
                    
                     <form action="delete.php" method="POST">
                      <input type="hidden" value="<?= $contact["id"]?>" name="id">
                         <input type="submit" class="btn btn-sm btn-outline-danger" value="O'chirish"   placeholder="O'chirish">
                     </form>
                   
                  
                  </div>
                  </td>
                 
                </tr>
            
                    <?php endforeach ?>
                
          </tbody>

            </table>
          </div>
        </section>
      </main>
    </div>
  </div>
</body>
</html>
