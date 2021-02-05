<?php
	session_start();

	require_once "classes/Cart.php";
	$title = "Purchase";
	require "./template/header.php";

	if(!isset($_SESSION["customer"])){
		header("Location: index.php");
	}
	if(isset($_SESSION['cart'])){

		$customer=unserialize($_SESSION["customer"]);
		$cart=unserialize($_SESSION["cart"]);
    ?>
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
			?>
		<tr>
			<td><?php echo $item->getName(); ?></td>
			<td><?php echo "$" . $item->getPrice(); ?></td>
			<td><?php echo $item->getQuantity(); ?></td>
			<td><?php echo "$" . $item->getTotal(); ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>Total</th>
			<th>&nbsp;</th>
			<th><?php echo $totalItems; ?></th>
			<th><?php echo "$" . $totalPrice; ?></th>
		</tr>
		<tr>
			<td>Shipping</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>$20.00</td>
		</tr>
		<tr>
			<th>Total Including Shipping</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo "$" . ($totalPrice + 20); ?></th>
		</tr>
	</table>
	<br>
	<br>
	<h4 style="margin-left:-20px">Your Inforamtion</h4>
	<br>
	<form method="post" action="process.php" class="form-horizontal">
	<div class="form-group">
        <label for="exampleInputEmail1">Firstname</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer->getFirstname()?>" name="firstname">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Lastname</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer->getLastname()?>" name="lastname">
    </div>

    <div class="form-group">
        <label for="inputAddress">Address</label>
        <input type="text" class="form-control" id="inputAddress" value="<?php echo $customer->getAddress()?>" name="address">
    </div>
    <div class="form-row">
	<div class="form-group col-md-2">
        </div>
        <div class="form-group col-md-4">
        <label for="inputCity">City</label>
        <input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $customer->getCity()?>">
        </div>
        <div class="form-group col-md-2">
        </div>
        <div class="form-group col-md-4">
        <label for="inputZip">Zip</label>
        <input type="text" class="form-control" id="inputZip" name="zipcode" value="<?php echo $customer->getZipcode()?>">
        </div>
    </div>
	<br>
    <div class="form-group col-md-12" >
        <div class="form-group" >
            <div class="col-lg-10 col-lg-offset-2" style="margin-left:0px">
              	<button type="reset" class="btn btn-default">Cancel</button>
              	<button type="submit" class="btn btn-primary">Purchase</button>
            </div>
        </div>
    </form>
	<p class="lead">Please press Purchase to confirm your purchase, or Cancel  to reset the form .</p>
<?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}

	require_once "./template/footer.php";
?>
