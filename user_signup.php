<?php
	session_start();
	$title = "User Signup";
	require "./template/header.php";

	require_once "classes/DBUtils.php";
	require_once "classes/Customer.php";
	 $conn = new DBUtils();

			foreach ($_POST as $key => $value) {
				$_POST[$key]=htmlspecialchars($value);
			}

				$customer=new Customer($_POST);

				$conn->insertCustomer($customer);

				header("Location:index.php");

?>

<?php

	require_once "./template/footer.php";
?>
