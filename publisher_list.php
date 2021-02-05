<?php
	session_start();

	require_once "classes/DBUtils.php";
	require_once "classes/Publisher.php";
	require_once "classes/Book.php";
	$conn = new DBUtils();

  $publishers=$conn->findAllPublishers();

	$title = "List Of Publishers";
	require "./template/header.php";
?>
	<p class="lead">List of Publisher</p>
	<ul>
	<?php
		foreach ($publishers as $publisher) {

			$books=$conn->getAllBooks();
			$count = 0;

			foreach ($books as $book) {
			// code...

				if($book->getPublisherID() == $publisher->getId()){
					$count++;
				}
			}
	?>
		<li>
			<span class="badge"><?php echo $count; ?></span>
		    <a href="bookPerPub.php?pubid=<?php echo $publisher->getId(); ?>"><?php echo $publisher->getName(); ?></a>
		</li>
	<?php } ?>
		<li>
			<a href="books.php">List full of books</a>
		</li>
	</ul>
<?php
	//mysqli_close($conn);
	require "./template/footer.php";
?>
