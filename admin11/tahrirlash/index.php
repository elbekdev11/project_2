<?php
$page="settings";
$link="../";
include("../layouts/header.php");
$u_id=$_SESSION["user_id"];


  $sql="SELECT * FROM users WHERE id=:id";
  $stmt=$conn->prepare($sql);
  $stmt->execute([
    ':id'=>$u_id
  ]);
  $admin=$stmt->fetch();
?>


      <main class="main-content d-lg-flex p-2 ">
        
      
           <section class="card-box mb-4 col-lg-6">
            <div>
              <?php
              if( !empty($_SESSION["settings_err"])) :
              ?>
               <h4 class="h4 mb-0 text-danger"><?= $_SESSION["settings_err"] ?></h4>
               <?php
               unset($_SESSION["settings_err"]);
                endif
               ?>
            </div>
          <div>
            <?php if( !empty( $_SESSION["settings_success"])) : ?>
             <h4 class="h4 mb-0 text-success"><?=  $_SESSION["settings_success"]?></h4>
             <?php 
            unset( $_SESSION["settings_success"]);
            endif?>
            </div>
             <form action="updatename.php" method="POST">
        <input type="hidden" name="id"  >
          <label>F.I.SH:</label> <br>
        <input type="text"  value="<?= $admin["name"]?>"  name="name" placeholder="Yangi ism" > <br> <br>
         <label>Email:</label> <br>
        <input type="text"    value="<?= $admin["email"]?>"  name="email" placeholder="Yangi email" >
        <br><br>
        <button type="submit">Saqlash</button>
    </form>

        </section>
         <section class="card-box mb-4 col-lg-6">
         <div>
              <?php
              if( !empty($_SESSION["pass_err"])) :
              ?>
               <h4 class="h4 mb-0 text-danger"><?= $_SESSION["pass_err"] ?></h4>
               <?php
               unset($_SESSION["pass_err"]);
                endif
               ?>
            </div>
          <div>
            <?php if( !empty( $_SESSION["pass_success"])) : ?>
             <h4 class="h4 mb-0 text-success"><?=  $_SESSION["pass_success"]?></h4>
             <?php 
            unset( $_SESSION["pass_success"]);
            endif?>
            </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
           
      

      <form  action="update_pass.php" method="POST">
    
     <label>Eski Parol:</label> <br>
    <input type="password" name="old_pass" placeholder="********"><br><br>
      <label>Yangi Parol:</label> <br>
  <input type="password" name="new_pass" placeholder="********" ><br><br>
    <label> Parolni tasdiqlash:</label> <br>
      
    <input type="password" name="confirm_pass" placeholder="********"><br><br>

    <button type="submit"  > Saqlash </button>

</form>
          </div>
            
        </section>
      
  
      </main>
    </div>
  </div>
</body>
</html>
