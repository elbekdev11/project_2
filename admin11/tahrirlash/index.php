<?php

$link="../";
include("../layouts/header.php");
?>


      <main class="main-content d-lg-flex p-2 ">
       

        <section class="card-box mb-4 col-lg-6">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Malumotlarni tahrirlash</h2>
          </div>
             <form action="updatename.php" method="POST">
        <input type="text" name="name" placeholder="Yangi ism" required>
        <button type="submit">Saqlash</button>
    </form>

        </section>
         <section class="card-box mb-4 col-lg-6">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Malumotlarni tahrirlash</h2>
      <form action="update.php" method="POST">
    
    <label>Yangi Email:</label><br>
    <input type="email" name="email" required><br><br>
     <label>Eski Parol:</label><br>
  <input type="password" name="password" required><br><br>
    <label>Yangi Parol:</label><br>
      
    <input type="password" name="password" required><br><br>

    <button type="submit">Saqlash</button>

</form>
          </div>
            
        </section>
  
      </main>
    </div>
  </div>
</body>
</html>
