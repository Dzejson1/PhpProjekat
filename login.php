<?php
  require_once "classes/Authentication.php";
  $title = "Login";

  $message = "";

  session_start();
  if(isset($_POST["loginSubmit"])) {

    if(!empty(htmlspecialchars($_POST["username"])) && !empty(htmlspecialchars($_POST["password"]))) {

      $loginSuccess = Authentication::login(htmlspecialchars($_POST["username"]), htmlspecialchars($_POST["password"]));
      if(!$loginSuccess) {
        $message = "Username or password incorrect";
        $error = true;
      }
    }
  }

?>
