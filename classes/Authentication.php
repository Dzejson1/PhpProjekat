<?php


  require_once("classes/Customer.php");

  require_once("classes/DBUtils.php");
  class Authentication {

    const LoginPageURL = "login.php";
    const SuccessPageURL = "login-success.php";
    private static $conn;

    
    public static function login($uname, $pword) {


      $db=new DBUtils();
      $row=$db->getCustomer($uname);
      if($row->getPassword()==$pword){
        $_SESSION["customer"] = serialize($row);
        header("Location: index.php");
        exit;
      }
      else{
        $row=$db->getManager($uname);
        if($row->getPassword()==$pword){
          $_SESSION["manager"] = serialize($row);
          header("Location: admin_book.php");
          exit;
        }

      }

        header("Location: index.php");
        exit;

    }


  }
?>
