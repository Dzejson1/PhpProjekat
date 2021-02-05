<?php

 require_once("classes/Book.php");
 require_once("classes/Customer.php");
 require_once("classes/Cart.php");
require_once("classes/Manager.php");

class DBUtils {

	private $conn;

	public function __construct($configFile = "config.ini") {
	if ($config = parse_ini_file($configFile)) {
					$host = $config["host"];
					$database = $config["database"];
					$user = $config["user"];
					$password = $config["password"];
					$this->conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
					$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
	}

	public function getManager($uname){


	try {
		$query = "select * from manager where name=:username";
		$st = $this->conn->prepare($query);
		$st->bindValue(":username", $uname);
		$st->execute();
		$pom = $st->fetch();
		return new Manager($pom);
		} catch(PDOException $e) {
			echo $e->getMessage();
			return null;
	}
	}


public function getCustomer($uname){


try {
	$query = "select * from customers where email=:username";
	$st = $this->conn->prepare($query);
	$st->bindValue(":username", $uname);
	$st->execute();
	$pom = $st->fetch();
	return new Customer($pom);
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
}
}



public function getPublisherName($id){


	try{
	$query="select publisher_name from publisher where publisherid=:id";
	$st = $this->conn->prepare($query);
	$st->bindValue(":id", $id);
	$st->execute();
	$pom = $st->fetch();
	return $pom[0];
	} catch(PDOException $e) {
	echo $e->getMessage();
	return null;
	}
}

public function getPublisherForName1($id){


	try{
	$query="select * from publisher where publisherid=:id";
	$st = $this->conn->prepare($query);
	$st->bindValue(":id", $id);
	$st->execute();
	$pom = $st->fetch();
	return new Publisher($pom);
	} catch(PDOException $e) {
	echo $e->getMessage();
	return null;
	}
}


public function findBookById($isbn){


	try{
	$query="select * from books where book_isbn=:id";
	$st = $this->conn->prepare($query);
	$st->bindValue(":id", $isbn);
	$st->execute();
	$pom = $st->fetch();
	return new Book($pom);

	} catch(PDOException $e) {
	echo $e->getMessage();
	return null;
	}
}

public function getCartForCustomerID($id){

	try{
	$query="select * from cart join cartitems join books on cart.id=cartitems.cartid and customerid=:id and cartitems.productid=books.book_isbn";
	$st = $this->conn->prepare($query);
	$st->bindValue(":id", $id);
	$st->execute();
	$pom = $st->fetchAll();
  $carts=[];

  if(!isset($pom[0][0])){
    throw new Exception('date error');
  }
    $idPrvi=$pom[0][0];
  $cart=new Cart();
  $cart->setId($pom[0][0]);
  $cart->setDate($pom[0][2]);
  foreach($pom as $elem) {
    if($elem[0]!=$idPrvi){
      $carts[]=$cart;
      $idPrvi=$elem[0];
      $cart=new Cart();
      $cart->setId($elem[0]);
      $cart->setDate($elem[2]);
    }
      $item = new Item($elem[7],$elem[8]." by ".$elem[9],$elem[12],$elem[6],$elem[12]*$elem[6]);
      $item->setImage($elem[10]);
      $cart->setItems($item);

  }
  $carts[]=$cart;

  return $carts;

	} catch(Exception $e) {
	echo $e->getMessage();
	return [];
	}
}


public function getBooksForPublisherID($pubId){


	try{
	$query="select * from books where publisherid=:id";
	$st = $this->conn->prepare($query);
	$st->bindValue(":id", $pubId);
	$st->execute();
	$pom = $st->fetchAll();
  $books = [];
  foreach($pom as $elem) {
    $book = new Book($elem);
    $books[] = $book;
  }
  return $books;

	} catch(PDOException $e) {
	echo $e->getMessage();
	return null;
	}
}

public function updateCustomer($id,$firstname,$lastname,$address,$city,$zipcode){


	try{
	$query="update customers set
  firstname=:firstname, lastname=:lastname , address=:address, city=:city, zipcode=:zipcode  where id=:id
  ";
	$st = $this->conn->prepare($query);
  $st->bindValue(":firstname", $firstname);
  $st->bindValue(":lastname", $lastname);
  $st->bindValue(":address", $address);
  $st->bindValue(":city", $city);
  $st->bindValue(":zipcode", $zipcode);
	$st->bindValue(":id", $id);
	$st->execute();

	} catch(PDOException $e) {
	echo $e->getMessage();
	return null;
	}
}

public function insertIntoCart($customerid,$date){

  $query = "insert into cart(customerid,date) VALUES(:customerid,:date) ";
  $st = $this->conn->prepare($query);
  $st->bindValue(":customerid", $customerid);
	$st->bindValue(":date", $date);

	return $st->execute();


}

public function getLastCartId( $customerid){
  $query = "select id from cart WHERE customerid = :customerid ORDER BY id desc LIMIT 1";
  $st = $this->conn->prepare($query);
  $st->bindValue(":customerid", $customerid);
  $st->execute();
  $pom = $st->fetch();

  return $pom["id"];

}

public function insertItem($item,$cartid){
  $query = "insert into cartitems(cartid,productid,quantity) VALUES(:cartid, :isbn, :quantity)";
  $st = $this->conn->prepare($query);
  $st->bindValue(":cartid", $cartid);
  $st->bindValue(":isbn", $item->getIsbn());
  $st->bindValue(":quantity", $item->getQuantity());
  $st->execute();
}


public function getCategoryForID($id){


	try{
	$query="select * from category where categoryid=:id";
	$st = $this->conn->prepare($query);
	$st->bindValue(":id", $id);
	$st->execute();
	$pom = $st->fetch();

	return new Category($pom);

	} catch(PDOException $e) {
	echo $e->getMessage();
	return null;
	}
}

public function getBooksForCategoryID($catId){


	try{
	$query="select * from books where categoryid=:id";
	$st = $this->conn->prepare($query);
	$st->bindValue(":id", $catId);
	$st->execute();
	$pom = $st->fetchAll();
  $books = [];
  foreach($pom as $elem) {
    $book = new Book($elem);
    $books[] = $book;
  }
  return $books;

	} catch(PDOException $e) {
	echo $e->getMessage();
	return null;
	}
}



public function getCategoryName($id){


	try{
	$query="select category_name from category where categoryid=:id";
	$st = $this->conn->prepare($query);
	$st->bindValue(":id", $id);
	$st->execute();
	$pom = $st->fetch();
	return $pom[0];
	} catch(PDOException $e) {
	echo $e->getMessage();
	return null;
	}
}

public function getAllBooks(){

	try {

			$query = "select * from books";
			$st = $this->conn->query($query);
			$rez = $st->fetchAll();
			$books = [];
			foreach($rez as $elem) {
				$book = new Book($elem);
				$books[] = $book;
			}
			return $books;
		} catch(PDOException $e) {
			echo $e->getMessage();
			return [];
		}

}

public function getAllBooksAsc(){

	try {

			$query = "select * from books order by book_price asc";
			$st = $this->conn->query($query);
			$rez = $st->fetchAll();
			$books = [];
			foreach($rez as $elem) {
				$book = new Book($elem);
				$books[] = $book;
			}
			return $books;
		} catch(PDOException $e) {
			echo $e->getMessage();
			return [];
		}

}

public function getAllBooksDesc(){

	try {

			$query = "select * from books order by book_price desc";
			$st = $this->conn->query($query);
			$rez = $st->fetchAll();
			$books = [];
			foreach($rez as $elem) {
				$book = new Book($elem);
				$books[] = $book;
			}
			return $books;
		} catch(PDOException $e) {
			echo $e->getMessage();
			return [];
		}

}


public function findAllPublishers(){
	try {
			$query = "select * from publisher";
			$st = $this->conn->query($query);
			$rez = $st->fetchAll();
			$publishers = [];
			foreach($rez as $elem) {
				$publisher = new Publisher($elem);
				$publishers[] = $publisher;
			}
			return $publishers;
		} catch(PDOException $e) {
			echo $e->getMessage();
			return [];
		}

}

public function findAllCategories(){

	try {

			$query = "select * from category";
			$st = $this->conn->query($query);
			$rez = $st->fetchAll();
			$categories= [];
			foreach($rez as $elem) {
				$category = new Category($elem);
				$categories[] = $category;
			}
			return $categories;
		} catch(PDOException $e) {
			echo $e->getMessage();
			return [];
		}

}



public function select4LatestBook(){
  $query = "select * from books order by book_isbn desc limit 4";
  $st = $this->conn->query($query);
  $rez = $st->fetchAll();
  $books = [];
  foreach($rez as $elem) {
    $book = new Book($elem);

    $books[] = $book;
  }
  return $books;

}



public function getCustomerIdbyEmail($email){

try{
$query="select * from customers where email=:email";
$st = $this->conn->prepare($query);
$st->bindValue(":email", $email, PDO::PARAM_STR);
$st->execute();
$pom = $st->fetch();
return new Customer($pom);
} catch(PDOException $e) {
echo $e->getMessage();
return null;
}

}


public function findBooksByName($title){

try{
$query = "select * from books where book_title like :title ";
$st = $this->conn->prepare($query);
$st->bindValue(":title", $title);
$st->execute();
$pom = $st->fetchAll();
$books=[];
foreach ($pom as $elem ) {
  $book=new Book($elem);
  $books[]=$book;
}
return $books;
} catch(PDOException $e) {
echo $e->getMessage();
return null;
}

}

	public function insertCustomer($customer){


		try {
	$sql = "insert into customers (firstname,lastname,email,address,password,city,zipcode) VALUES (:fn, :ls, :em,:pas,:ad,:ci,:zip)";


	$st = $this->conn->prepare($sql);
  $st->bindValue(":fn", $customer->getFirstname());
	$st->bindValue(":ls", $customer->getLastname());
  $st->bindValue(":em", $customer->getEmail());
	$st->bindValue(":pas", $customer->getPassword());
	$st->bindValue(":ad", $customer->getAddress());
	$st->bindValue(":ci", $customer->getCity());
	$st->bindValue(":zip", $customer->getZipcode());
	return $st->execute();
				} catch (PDOException $e) {
						return false;
			}
	}

  public function insertBook($book){

		try {
	$sql = "insert into books (book_isbn,book_title,book_author,book_image,book_descr,book_price,publisherid,categoryid) VALUES (:is, :ti, :au,:im,:de,:pr,:pu,:ca)";


	$st = $this->conn->prepare($sql);
  $st->bindValue(":is", $book->getBookIsbn());
	$st->bindValue(":ti", $book->getBookTitle());
  $st->bindValue(":au", $book->getBookAuthor());
	$st->bindValue(":im", $book->getBookImage());
	$st->bindValue(":de", $book->getBookDescr());
	$st->bindValue(":pr", $book->getBookPrice());
	$st->bindValue(":pu", $book->getPublisherID());
  $st->bindValue(":ca", $book->getCategoryID());
	return $st->execute();
				} catch (PDOException $e) {
						return false;
			}
	}


}
