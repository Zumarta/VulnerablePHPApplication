<?php include('headArea.php') ?>

<?php include('header.php') ?>

<?php 
include_once('db.php');
$success = -1;

if(isset($_POST["title"]) && isset($_FILES)) {
  
  $title = $_POST["title"];
  $targetDirectory = "images/";
  $fileName = basename($_FILES["fileUpload"]["name"]);
  $targetFile = $targetDirectory . $fileName;
  $success = 0;

  if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $targetFile)) {
    // If file moving succeeded, we create a db entry for that.
    $sql = "INSERT INTO images(title, imgpath) VALUES ('$title', '$fileName');";
    if($conn->query($sql) === true) {
      $success = 1;
    }
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
    Upload fehlgeschlagen! Wieso nur?
  </div>
  <?php
    } elseif ($success == 1) {
  ?>
  <div class="alert alert-success" role="alert">
    Upload erfolgreich! <i class="fa fa-smile-o" aria-hidden="true"></i>
  </div>
  <?php
    }
  ?>

  <form action="image_upload.php" method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal">Bild hochladen</h1>

    <div class="form-group">
      <label for="title">Titel für das Bild</label>
      <input required type="title" class="form-control" id="title" name="title" aria-describedby="title"
        placeholder="Katze fällt von Gardine">
    </div>

    <div class="form-group">
      <label for="fileUpload" class="form-label">Datei auswählen</label>
      <input required class="form-control form-control-sm" id="fileUpload" name="fileUpload" type="file" />
    </div>

    <button type="submit" class="btn btn-primary mt-2">Hochladen</button>
    <a href="images.php?id=1" class="btn btn-secondary mt-2"> Zum 1. Bild</a>
  </form>
</main>

<?php include('footer.php') ?>
