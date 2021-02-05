<?php
	$title = "User SignIn";
	require_once "./template/header.php";
?>

	<form class="form-horizontal" method="post" action="login.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter username" name="username">
    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="password">
  </div>

	<input type="submit" name="loginSubmit" id="loginSubmit" value="Sign in">
</form>

<?php
	require_once "./template/footer.php";
?>
