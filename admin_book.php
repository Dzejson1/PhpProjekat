<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "List book";
	require_once "./template/header.php";

	require_once "classes/DBUtils.php";
	require_once "classes/Book.php";
	 $conn = new DBUtils();

	$books = $conn->getAllBooks();

	$fileName="";

		if (isset($_POST['btnUpload'])) {
		if(is_uploaded_file($_FILES['file']['tmp_name'])) {

  				$fileName = $_FILES['file']['tmp_name'];
					parseAndInsert($fileName, $conn);
				}
				      header("Location: admin_book.php");

	}

		function parseAndInsert($fileName, $conn) {
			$file = fopen($fileName, "r");

			while($line = fgetcsv($file, 1000, ";")) {
					$booksArray=array("book_title"=>$line[0],"book_author"=>$line[1],"book_image"=>$line[2],"book_descr"=>$line[3],"book_price"=>$line[4],"publisherid"=>$line[5],
				"categoryid"=>$line[6]);


				$book=new Book($booksArray);

			$conn->insertBook($book);

			}
	fclose($file);
	}
?>
	<div>

		<?php
			if (isset($_SESSION['manager'])){
				echo '<a class="btn btn-primary" href="admin_add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Book</a>';

		echo '

		<form method="post" enctype="multipart/form-data">
				<table class="table">

					<tr >

						<td style="width: 200px;"><input class="btn btn-primary"  type="file" name="file"></td>
						<td ><input type="submit" name="btnUpload" value="Add new book from csv" class="btn btn-primary"></td>

					</tr>

				</table>


			</form> ';

			}
			?>


	</div>

	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ISBN</th>
			<th>Title</th>
			<th>Author</th>
			<th>Image</th>
			<th>Description</th>
			<th>Price</th>
			<th>Publisher</th>
			<th>Category</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php

		?>

		<?php foreach($books as $key=>$book){


			?>
		<tr>
			<td><?php echo $book->getBookIsbn(); ?></td>
			<td><?php echo $book->getBookTitle(); ?></td>
			<td><?php echo $book->getBookAuthor(); ?></td>
			<td><?php echo $book->getBookImage(); ?></td>
			<td><?php echo $book->getBookDescr(); ?></td>
			<td><?php echo $book->getBookPrice(); ?></td>
			<td><?php echo $conn->getPublisherName($book->getPublisherID()); ?></td>
			<td><?php echo $conn->getCategoryName($book->getCategoryID()); ?></td>
			<?php
				 if (isset($_SESSION['manager'])){
					echo '<td><a href="#"><span class="glyphicon glyphicon-trash"></span>Delete</a></td>';


				}
			?>

		</tr>
	<?php } ?>

	</table>

 <?php

	require_once "./template/footer.php";
?>
