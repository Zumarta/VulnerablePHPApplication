<?php include('headArea.php') ?>

<?php include('header.php') ?>

<?php 
include_once('db.php');

$success = -1;



if(isset($_POST["username"]) && isset($_POST["password"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $query = "SELECT * FROM users WHERE username = '$username' AND passwd = '$password'";
  $sql = $conn->query($query);
  $user = mysqli_fetch_assoc($sql);

  if($user) {
    $success = 1;
    session_start();
    $_SESSION["username"] = $user["username"];
    $_SESSION["loggedIn"] = true;
    header("Location:images.php?id=1");
  } else {
    $success = 0;
  }
}

if($conn) $conn->close();
?>

<main class="form-signin">
  <?php
    if($success == 0) {
  ?>
  <div class="alert alert-danger" role="alert">
    Irgendwas lief da wohl schief.
  </div>
  <?php
    }
  ?>
  <form action="login.php" method="post">
    <h1 class="h3 mb-3 fw-normal">Bitte anmelden!</h1>

    <div class="form-group">
      <label for="text">Username</label>
      <input required type="text" class="form-control" id="username" aria-describedby="username"
        placeholder="xX_HackeR__Xx" name="username">
      <small id="username" class="form-text text-muted">Deine Daten sind sicher bei uns! :)</small>
    </div>

    <div class="form-group">
      <label for="passwordInput">Passwort</label>
      <input required name="password" type="password" class="form-control" id="passwordInput" placeholder="Passwort">
    </div>

    <button type="submit" class="btn btn-primary">Anmelden</button>
  </form>
</main>

<?php include('footer.php') ?>
