<?php include('headArea.php') ?>

<?php include('header.php') ?>

<!-- Check ob man schon angemeldet ist ;) -->
<?php
include_once('db.php');

$success = -1;

if(isset($_POST["username"])
    && isset($_POST["firstname"])
    && isset($_POST["lastname"])
    && isset($_POST["password"])) {

  $username = $_POST["username"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $password = $_POST["password"];

  $sql = "INSERT INTO users (username, firstname, passwd, surname) VALUES ('$username', '$firstname', '$password', '$lastname');";
  if($conn->query($sql) === true) {
    $success = 1;
  }
}
?>
<main class="form-signin">
  <?php
    if($success == 1) {
  ?>
  <div class="alert alert-success" role="alert">
    Registrierung erfolgreich! <i class="fa fa-smile-o" aria-hidden="true"></i>
    Bitte melde Dich nun an: <a href="login.php">Login</a>.
  </div>
  <?php
    } elseif ($success == 0) {
  ?>
  <div class="alert alert-danger" role="alert">
    Registrierung fehlgeschlagen! Wieso nur?
  </div>
  <?php
    }
  ?>
  <form action="register.php" method="post">

    <h1 class="h3 mb-3 fw-normal">Bitte registrieren!</h1>

    <div class="form-group">
      <label for="userHelp">Benutzername</label>
      <input required type="text" class="form-control" id="userHelp" aria-describedby="userHelp" name="username"
        placeholder="xX_HackeR__Xx">
      <small id="userHelp" class="form-text text-muted">Deine Daten sind sicher bei uns! :)</small>
    </div>

    <div class="form-group">
      <label for="firstname">Vorname</label>
      <input required type="text" class="form-control" id="firstnameInput" name="firstname" placeholder="Vorname">
    </div>

    <div class="form-group">
      <label for="lastname">Nachname</label>
      <input required type="tet" class="form-control" id="lastnameInput" name="lastname" placeholder="Nachname">
    </div>

    <div class="form-group">
      <label for="passwordInput">Passwort</label>
      <input required type="password" class="form-control" id="passwordInput" name="password" placeholder="Passwort">
    </div>
    <button type="submit" class="btn btn-primary">Registrieren</button>
  </form>
</main>

<?php include('footer.php') ?>
