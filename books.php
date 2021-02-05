<?php
  session_start();
  $count = 0;
  // connecto database

  require_once "classes/DBUtils.php";
  require_once "classes/Category.php";
  require_once "classes/Book.php";

  $conn = new DBUtils();

 if(isset($_POST['price'])){
    if(isset($_POST['asc'])){
      $books=$conn->getAllBooksAsc();
    }
    else if(isset($_POST['desc'])){
      $books=$conn->getAllBooksDesc();
    }
  }else{
    $books=$conn->getAllBooks();
  }
  $title = "Full Catalogs of Books";
  require_once "./template/header.php";
?>

  <p class="lead text-center text-muted">Full Catalogs of Books</p>
<h5 class="lead text-muted">Sort By:</h5>

<form method="post" action="books.php">
  <div class="radio">
    <label><input type="radio" name="asc" >Ascending</label>
  </div>
  <div class="radio">
    <label><input type="radio" name="desc">Descending</label>
  </div>


  <button type="submit" class="btn btn-secondary" name="price">Price</button>

  <button type="submit" class="btn btn-secondary" name="clear">Clear</button>

</form>

<br><br>

      <div class="row">
        <?php foreach ($books as $book) {?>
          <div class="col-md-3">
            <a href="book.php?bookisbn=<?php echo $book->getBookIsbn(); ?>">
              <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book->getBookImage(); ?>">
              </a>
              <table>
                <tr>
                  <td><strong>  <?php echo $book->getBookTitle(); ?></strong></td>
                </tr>
                <tr>
                <td> <?php echo $book->getBookAuthor(); ?></td>
                </tr>
                <tr>
                <td><strong>$<?php echo $book->getBookPrice();?></strong>  </td>
                </tr>
              </table>
            </div>
            <?php
              } ?>
      </div>
      <br><br>
<?php

  require_once "./template/footer.php";
?>

 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
