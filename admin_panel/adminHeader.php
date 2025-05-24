<?php
include_once "./config/dbconnect.php";  // Assuming this is the correct path to your DB connection
?>

<!-- nav -->
<nav class="navbar navbar-expand-lg navbar-light px-5" style="background-color: #3B3131;">
    <a class="navbar-brand ml-5" href="./index.php">
        <img src="./assets/images/pexels-photo-427547.webp" width="80" height="80" alt="Swiss Collection" style="border-radius: 100%; width: 100px; height: 100px; object-fit: cover;">
    </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>

    <div class="user-cart">  
        <?php           
        if(isset($_SESSION['user_id'])){
          ?>
          <!-- Admin icon -->
          <a href="admin.php" style="text-decoration:none;">
            <i class="fa fa-user mr-3" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
          </a>
          <!-- Logout button -->
          <a href="index.php" style="text-decoration:none;">
            <i class="fa fa-sign-out mr-5" style="font-size:30px; color:#fff;" aria-hidden="true" title="Logout"></i>
          </a>
          <?php
        } else {
            ?>
            <!-- Login icon -->
            <a href="index.php" style="text-decoration:none;">
                <i class="fa fa-sign-in mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
            </a>
        <?php
        } ?>
    </div>  
</nav>

