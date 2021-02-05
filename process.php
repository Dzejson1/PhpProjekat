<?php
	session_start();


	$title = "Purchase Process";
	require "./template/header.php";
	require_once "classes/DBUtils.php";
	require_once "classes/Cart.php";

$conn = new DBUtils();

		$firstname = trim(htmlspecialchars($_POST['firstname']));

		$lastname = trim(htmlspecialchars($_POST['lastname']));

		$address = trim(htmlspecialchars($_POST['address']));

		$city = trim(htmlspecialchars($_POST['city']));

		$zipcode = trim(htmlspecialchars($_POST['zipcode']));

		$customer=unserialize($_SESSION["customer"]);
	$id=$customer->getId();

	$conn->updateCustomer($id,$firstname,$lastname,$address,$city,$zipcode);

	$date = date("Y-m-d H:i:s");

	$conn->insertIntoCart($customer->getId(),$date);


	$cartId = $conn->getLastCartId( $customer->getId());

	$cart=unserialize($_SESSION["cart"]);
	foreach($cart->getItems() as $item){

		$conn->insertItem($item,$cartId);

	}


	unset($_SESSION["cart"]);

header("Location: index.php");

?>
	

<?php

	require_once "./template/footer.php";
?>
