<?php
session_start();
?>

<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <img src="assets/home.png" width="30" height="30" class="d-inline-block align-top" alt="">
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="index.php" class="nav-link px-2 text-white">Home</a></li>
        <li><a href="images.php?id=1" class="nav-link px-2 text-white">Bilder</a></li>
      </ul>

      <div class="text-end">
        <?php
          if(isset($_SESSION['username']) && $_SESSION['loggedIn']) {
            echo "Hallo, " . $_SESSION['username'];
            ?>
            </br>
            <button type="button" onclick="window.location.href = 'logout.php';" class="btn btn-warning">Logout</button>
            <?php } else { 
          ?>
        <button type="button" onclick="window.location.href = 'login.php';" class="btn btn-warning">Login</button>
        <?php } ?>
      </div>
    </div>
  </div>
</header>