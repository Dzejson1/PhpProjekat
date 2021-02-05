<?php
  session_start();
  $book_isbn = htmlspecialchars($_GET['bookisbn']);

  require_once "classes/Book.php";
  require_once "classes/Category.php";
  require_once "classes/DBUtils.php";
  $conn=new DBUtils();
  $book=$conn->findBookById($book_isbn);
  $kategorija=$conn->getCategoryForID($book->getCategoryID())->getName();

  if(!isset($_COOKIE["books4"])){
    $booksPom=array();

    $booksPom[]=$book_isbn;
    setcookie("books4", serialize($booksPom), time() + 60*60*24*7);
  }else{

    $booksPom=unserialize($_COOKIE["books4"]);

    if(!in_array($book_isbn,$booksPom)){
        $booksPom[]=$book_isbn;
    }
    if(count($booksPom)>=5){
      array_shift($booksPom);
    }
    setcookie("books4", serialize($booksPom), time() + 60*60*24*7);
    $booksPom=unserialize($_COOKIE["books4"]);

  }



  require "./template/header.php";
?>

      <p class="lead" style="margin: 25px 0"><a href="books.php">Books</a> > <?php echo $book->getBookTitle(); ?></p>
      <div class="row">
        <div class="col-md-3 text-center">
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book->getBookImage(); ?>">
        </div>
        <div class="col-md-6">
          <h4>Book Description</h4>
          <p><?php echo $book->getBookDescr(); ?></p>
          <h4>Book Details</h4>
          <table class="table">

            <tr>
              <td><?php echo "ISBN"; ?></td>
              <td><?php echo $book->getBookIsbn(); ?></td>
            </tr>

            <tr>
              <td><?php echo "Author"; ?></td>
              <td><?php echo $book->getBookAuthor(); ?></td>
            </tr>

            <tr>
              <td><?php echo "Price"; ?></td>
              <td><?php echo $book->getBookPrice(); ?></td>
            </tr>

            <tr>
              <td><?php echo "Kategorija"; ?></td>
              <td><?php echo $kategorija; ?></td>
            </tr>
            <?php

            ?>
          </table>
          <form method="post" action="cart.php">
            <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">

            <input type="submit" value="Add to cart" name="cart" class="btn btn-primary">
          </form>
       	</div>
      </div>
<?php
  require "./template/footer.php";
?>
