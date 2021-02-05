<?php

  $text = trim(htmlspecialchars($_POST['text']));

  require_once "classes/DBUtils.php";
  $conn = new DBUtils();
  $books=$conn->findBooksByName($text);

  require_once "./template/header.php";
?>

  <p class="lead text-center text-muted">Search Result</p>
    <?php foreach ($books as $book) {?>


      <div class="row">

          <div class="col-md-3">
            <a href="book.php?bookisbn=<?php echo $book->getBookIsbn(); ?>">
              <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book->getBookImage(); ?>">
            </a>
          </div>

      </div>
<?php
      }
  //if(isset($conn)) { mysqli_close($conn); }
  require_once "./template/footer.php";
?>
