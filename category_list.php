<?php
	session_start();


	 require_once "classes/DBUtils.php";
	 require_once "classes/Publisher.php";
	 require_once "classes/Book.php";
	 require_once "classes/Category.php";
	 $conn = new DBUtils();
	 $categories=$conn->findAllCategories();

	$title = "List Of Categories";
	require "./template/header.php";
?>
	<p class="lead">List of Category</p>
	<ul>
	<?php
			foreach ($categories as $category) {
			$count = 0;
			$books=$conn->getAllBooks();
			foreach ($books as $book) {

					if($book->getCategoryID() == $category->getId()){
						$count++;
					}
				}
	?>
		<li>
			<span class="badge"><?php echo $count; ?></span>
		    <a href="bookPerCat.php?catid=<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></a>
		</li>
	<?php } ?>
		<li>
			<a href="books.php">List full of books</a>
		</li>
	</ul>
<?php

	require "./template/footer.php";
?>
