<?php
	session_start();
	session_unset();
	session_destroy();
	//if(isset($conn)){ mysqli_close($conn); }
	header("Location: index.php");
?>
