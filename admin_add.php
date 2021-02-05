<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "Add new book";
	require "./template/header.php";

	require_once "classes/DBUtils.php";
		require_once "classes/Book.php";
	 $conn = new DBUtils();


	if(isset($_POST['add'])){



		$title = trim(htmlspecialchars($_POST['book_title']));


		$author = trim(htmlspecialchars($_POST['book_author']));


		$descr = trim(htmlspecialchars($_POST['book_descr']));


		$price = floatval(htmlspecialchars(trim($_POST['book_price'])));


			$publisher = trim(htmlspecialchars($_POST['publisherid']));


			$category = trim(htmlspecialchars($_POST['categoryid']));


			if (isset($_POST["add"])) {
				if(is_uploaded_file($_FILES['book_image']['tmp_name'])) {
						if(isset($_FILES["book_image"]) && $_FILES["book_image"]["error"] == UPLOAD_ERR_OK){

								$filename=$_FILES["book_image"]["name"];


									$message="dobro je sve";
									if (isset($filename) && !move_uploaded_file($_FILES["book_image"]["tmp_name"], "bootstrap/img/$filename")) {
											$message = "Server error.";
										}

			} else {
					$message = "Invalid operation.";
			}


			$_POST["book_image"] =$filename;

				$book=new Book($_POST);

					$conn->insertBook($book);


}


}





	}
?>
	<form method="post" action="admin_add.php" enctype="multipart/form-data">
		<table class="table">

			<tr>
				<th>Title</th>
				<td><input type="text" name="book_title" required></td>
			</tr>
			<tr>
				<th>Author</th>
				<td><input type="text" name="book_author" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="book_image"></td>
			</tr>
			<tr>
				<th>Description</th>
				<td><textarea name="book_descr" cols="40" rows="5"></textarea></td>
			</tr>
			<tr>
				<th>Price</th>
				<td><input type="text" name="book_price" required></td>
			</tr>
			<tr>
				<th>Publisher</th>
				<td><input type="text" name="publisherid" required></td>
			</tr>
			<tr>
				<th>Category</th>
				<td><input type="text" name="categoryid" required></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Add new book" class="btn btn-primary">
		<input type="reset" value="cancel" class="btn btn-default">
	</form>
	<br/>
<?php

	require_once "./template/footer.php";
?>
