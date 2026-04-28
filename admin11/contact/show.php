<?php
$link="../";
include("../layouts/header.php");

$m_id=$_GET["m_id"];
$sql="SELECT * FROM contact WHERE id=:id";

$stmt=$conn->prepare($sql);
$stmt->execute([
  ':id'=>$m_id
]);
$message=$stmt->fetch();
  if($message["view"]==0){
    $sql="UPDATE contact SET view=:view WHERE id=:id ";
    $stmt=$conn->prepare($sql);
    $stmt->execute([
      ':view'=>1,
      ':id'=>$m_id
    ]);
  }

?>
 <main class="main-content">
       

        <section class="card-box mb-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Xabarni to'liq o'qish</h2>
          </div>
          <form class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Ism</label>
                <h4><?= $message["name"] ?></h4>
            </div>
            <div class="col-md-6">
              <h4 class="form-label">Email:</h4>
               <h4><?= $message["email"] ?></h4>
            </div>
            <div class="col-md-12">
              <label class="form-label">Habar mavzusi</label>
              <h4><?= $message["mavzu"] ?></h4>
            </div>
            
            <div class="col-12">
              <label class="form-label">Toliq matin</label>
              <p><?= $message["xabaringiz"] ?></p>
            </div>
            <div class="col-12 d-flex gap-2">
              <a href="index.php" class="btn btn-primary">Qaytish</a>
              
            </div>
          </form>
        </section>

        
      </main>
    </div>
  </div>
</body>
</html>




