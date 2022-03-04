<?php include('headArea.php') ?>

<?php include('header.php') ?>

<?php
include_once('db.php');
$success = 0;

if(isset($_GET["id"])) {
  $imageId = $_GET["id"];
  
  $prevId = ($imageId <= 1) ? 1 : $imageId - 1;
  $nextId = $imageId + 1;

  if(isset($_POST["comment"])) {
    $comment = $_POST["comment"];
    $sql = "INSERT INTO comments(author, comment, imageId) VALUES ('thaddäus', '$comment', '$imageId');";
    if($conn->query($sql) === true) {
      $success = 1;
    }
  }

  $imagesSql = $conn->query("SELECT * FROM images WHERE id = '$imageId';");
  $result = mysqli_fetch_assoc($imagesSql);

  $commentsSql = $conn->query("SELECT * from comments WHERE imageId = '$imageId';");
}

?>

<main>
  <div class="mx-auto">

  </div>

  <section class="py-5 container">
    <?php 
    if($success) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Kommentar gespeichert! <i class="fa fa-smile-o" aria-hidden="true"></i>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php 
    }
    ?>
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <div class="text-end ">
          <a href="image_upload.php" class="btn btn-outline-primary my-2">Bild hochladen <i class="fa fa-upload"
              aria-hidden="true"></i>
            </i>
          </a>
        </div>
        <h2 class="text-center fw-light mb-5 pb-3 border-bottom">
          <?php 
          if(isset($result)) {
            echo $result['title']; 
          } else {
            echo "Kein Bild gefunden";
          }
          ?>
        </h2>

        <img src="<?php if(isset($result)) { echo "images/" . $result['imgPath']; } else { echo "images/demo.svg"; } ?>"
          class="mx-auto d-block img-fluid" alt="Responsive image" />

        <!-- Buttons -->
        <div class="container text-center">
          <p>
            <a href="images.php?id=<?php echo $prevId ?>" class="btn btn-sm btn-outline-primary my-2">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>

            <a href="#" class="btn btn-sm btn-outline-info my-2"> <i class="fa fa-download" aria-hidden="true"></i>
              </i>
            </a>

            <a href="images.php?id=<?php echo $nextId ?>" class="btn btn-sm btn-outline-primary my-2"> <i
                class="fa fa-arrow-right" aria-hidden="true"></i>
              </i>
            </a>
          </p>

        </div>

        <!-- Comment Section -->
        <div class="container">
          <div class="mt-3 rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0">Kommentare</h6>

            <?php
              while($row = $commentsSql->fetch_assoc()) {

            ?>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">@<?php echo $row['author'] ?></strong>
                <?php echo $row['comment'] ?>
              </p>
            </div>
            <?php } ?>
          </div>
          <form action="images.php?id=<?php echo $imageId ?>" method="post">
            <div class="input-group mt-2">
              <span class="input-group-text">Kommentar</span>
              <textarea required class="form-control" aria-label="name" name="comment"></textarea>
              <button type="submit" class="btn btn-small btn-primary"><i class="fa fa-send"
                  aria-hidden="true"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php 
$conn->close();
include('footer.php') 
?>
