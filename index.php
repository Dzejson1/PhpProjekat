<?php
  session_start();
  $count = 0;

  $title = "Index";
  require_once "./template/header.php";
  require_once "classes/DBUtils.php";
  require_once "classes/Book.php";
  $conn=new DBUtils();
?>

     <br/> <br/>
      <p class="lead text-center text-muted">MOST RECENT BOOKS</p>
      <br><br>
      <div class="row">
          <?php
          if(isset($_COOKIE["books4"])){
          $books=unserialize($_COOKIE["books4"]);

       foreach($books as $book_isbn) {
          $book=$conn->findBookById($book_isbn);
           ?>

      	<div class="col-md-3">
      		<a href="book.php?bookisbn=<?php echo $book->getBookIsbn();?>">
           <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book->getBookImage(); ?>">
          </a>
      	</div>
        <?php }
      } ?>
      </div>
<?php

  require_once "./template/footer.php";
?>
