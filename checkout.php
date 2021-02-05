<?php
	session_start();

	$title = "Checking out";
	require "./template/header.php";
	require_once "classes/Cart.php";
	if(!isset($_SESSION["customer"])){
		echo '<div class="alert alert-danger" role="alert">
		You Need to <a href="Signin.php">Signin</a> First!
	  </div>';
	}

	if(isset($_SESSION['cart'])){
?>
	<table class="table">
		<tr>
			<th>Item</th>
			<th>Price</th>
	    	<th>Quantity</th>
	    	<th>Total</th>
	    </tr>
	    	<?php
				 	$cart= unserialize($_SESSION["cart"]);

					$totalPrice=0;
					$totalItems=0;
			    foreach($cart->getItems() as $item){
						$totalPrice+=$item->getTotal();
						$totalItems+=$item->getQuantity();

			?>
		<tr>
			<td><?php echo $item->getName(); ?></td>
			<td><?php echo "$" . $item->getPrice(); ?></td>
			<td><?php echo $item->getQuantity(); ?></td>
			<td><?php echo "$" . $item->getTotal(); ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo $totalItems; ?></th>
			<th><?php echo "$" . $totalPrice; ?></th>
		</tr>
	</table>
	<?php
		if(isset($_SESSION["customer"])){
			echo '<form method="post" action="purchase.php" class="form-horizontal">
			<div class="form-group" style="margin-left:0px">
				<input type="submit" name="submit" value="Purchase" class="btn btn-primary" >
				<a href="cart.php" class="btn btn-primary">Edit Cart</a>
			</div>
		</form>
		<p class="lead">Please press Purchase to confirm your purchase, or Edit Cart to add or remove items.</p>';
		}
	?>

<?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}

	require_once "./template/footer.php";
?>
