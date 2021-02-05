<?php
	session_start();

	require_once "classes/DBUtils.php";
	  require_once "classes/Publisher.php";
		require_once "classes/Book.php";


	if(isset($_GET['pubid'])){
		$pubid = htmlspecialchars($_GET['pubid']);
	} else {
		echo "Wrong query! Check again!";
		exit;
	}

	$conn = new DBUtils();
	$publisher = $conn->getPublisherForName1($pubid);

	$books=$conn->getBooksForPublisherID($publisher->getId());

	$title = "Books Per Publisher";
	require "./template/header.php";
?>
	<p class="lead"><a href="publisher_list.php">Publishers</a> > <?php echo $publisher->getName(); ?></p>
	<?php foreach ($books as $book) {

?>
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book->getBookImage();?>">
		</div>
		<div class="col-md-7">
			<h4><?php echo $book->getBookTitle();?></h4>
			<a href="book.php?bookisbn=<?php echo $book->getBookIsbn();?>" class="btn btn-primary">Get Details</a>
		</div>
	</div>
	<br>
<?php
	}

	require "./template/footer.php";
?>
