<?php

	session_start();

	  require_once "classes/DBUtils.php";
		require_once "classes/Cart.php";

	$conn = new DBUtils();

	if(isset($_POST['bookisbn'])){
		$book_isbn = htmlspecialchars($_POST['bookisbn']);
	}
	if(!isset($_SESSION["cart"])){
		$_SESSION["cart"] = serialize(new Cart());

	}
		$cart= unserialize($_SESSION["cart"]);

	if(isset($book_isbn)){


		$isbns=$cart->getIsbns();

		if (!in_array($book_isbn, $cart->getIsbns())) {

			$book=$conn->findBookById($book_isbn);

			$name=$book->getBookTitle()." by ".$book->getBookAuthor();
			$cart->setItems(new Item($book_isbn,$name,$book->getBookPrice(),1,$book->getBookPrice()));
			

		}
		 else{


			 $item->setQuantity($item->getQuantity()+1);
			 $item->setTotal($item->getQuantity()*$item->getPrice());
		}
			 $_SESSION["cart"] = serialize($cart);
	}



	if(isset($_POST['save_change'])){
		foreach ($_POST["isbn"] as $book_isbn => $quantity) {
				if($quantity!=0){
					  $item=$cart->getItemForIsbn($book_isbn);
					  $item->setQuantity($quantity);
						$item->setTotal($item->getQuantity()*$item->getPrice());
						$_SESSION["cart"] = serialize($cart);
					}else{
						$cart= unserialize($_SESSION["cart"]);
						$cart->removeBookFromCart($book_isbn);
						$_SESSION["cart"] = serialize($cart);

					}
		}
	}

	// print out header here
	$title = "Your shopping cart";
	require "./template/header.php";
	if(isset($_SESSION['cart'])){

?>
   	<form action="cart.php" method="post">
	   	<table class="table">
	   		<tr>
	   			<th>Item</th>
	   			<th>Price</th>
	  			<th>Quantity</th>
	   			<th>Total</th>
	   		</tr>
	   		<?php

			$totalPrice=0;
			$totalItems=0;
		    	foreach($cart->getItems() as $item){
						$totalPrice+=$item->getTotal();
						$totalItems+=$item->getQuantity();

					$isbnPom=$item->getIsbn();
					$quantityPom=$item->getQuantity();
			?>
			<tr>
				<td><?php echo $item->getName(); ?></td>
				<td><?php echo "$" . $item->getPrice(); ?></td>
				<td><input type="text" value="<?php echo $quantityPom; ?>" size="2" name="isbn<?php echo "[$isbnPom]"; ?>"></td>

				<td><?php echo "$" . $item->getTotal(); ?></td>
			</tr>
			<?php } ?>
		    <tr>
		    	<th>&nbsp;</th>
		    	<th>&nbsp;</th>
		    	<th>
					 <?php echo $totalItems; ?>
					</th>
		    	<th>
						 <?php echo "$" . $totalPrice; ?>
					</th>
		    </tr>
	   	</table>
		   <button type="submit" class="btn btn-primary" name="save_change"><span class="glyphicon glyphicon-ok"></span>&nbsp;Save Changes</button>

	</form>
	<br/><br/>
	<a href="checkout.php" class="btn btn-primary">Go To Checkout</a>
	<a href="books.php" class="btn btn-primary">Continue Shopping</a>
<?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}




	if(isset($_SESSION["customer"])){

		$customer=unserialize($_SESSION["customer"]);
		if(!isset($_SESSION["cart"])){

			$_SESSION["cart"] = serialize(new Cart());


		}

		$cart= unserialize($_SESSION["cart"]);

		$cartsPom=$conn->getCartForCustomerID($customer->getId());//Cart

	 echo '	<br><br><br><h4>Your Purchase History</h4><table class="table">
	 <tr>
		 <th>Item</th>
		 <th>Quantity</th>
		<th>Date</th>
	 </tr>';

		$i=0;
		foreach ($cartsPom as $cartPom) {
			// code...

		foreach ($cartPom->getItems() as $item) {
			//  print_r($item);
				echo '<tr>
				<td>
				<a href="book.php?bookisbn=';
				echo $item->getIsbn();
				echo '">';
				echo '<img style="height:100px;width:80px"class="img-responsive img-thumbnail" src="./bootstrap/img/';
				echo $item->getImage();
				echo '">';
				echo ' </a>
				</td>
				<td>';
				echo $item->getQuantity();
				echo '
				</td>
				<td>';
				echo $cartPom->getDate();
				echo'
				</td>
				</tr>';
				$i++;

		}
	}
		echo '</table>';

}
?>
<?php

	require_once "./template/footer.php";?>
