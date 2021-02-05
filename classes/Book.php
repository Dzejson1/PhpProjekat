<?php

/**
 *
 */
class Book
{
  private $book_isbn;
  private $book_title;
  private $book_author;
  private $book_image;
  private $book_descr;
  private $book_price;
  private $publisherid;
  private $categoryid;



  function __construct($book)

  {
    if(isset($book["book_isbn"])){
      $this->book_isbn=$book["book_isbn"];
    }

    $this->book_title=$book["book_title"];
    $this->book_author=$book["book_author"];
    $this->book_image=$book["book_image"];
    $this->book_descr=$book["book_descr"];
    $this->book_price=$book["book_price"];
    $this->publisherid=$book["publisherid"];
    $this->categoryid=$book["categoryid"];
  }

  public function getBookIsbn(){
    return $this->book_isbn;
  }


  public function getBookTitle(){
    return $this->book_title;
  }
  public function setBookTitle($book_title_pom){
    $this->book_title=$book_title_pom;
  }

  public function getBookAuthor(){
    return $this->book_author;
  }
  public function setBookAuthor($book_author_pom){
    $this->book_author=$book_author_pom;
  }

  public function getBookImage(){
    return $this->book_image;
  }

  public function setBookImage($book_image_pom){//ovde se buni sto ovde?
    $this->book_image=$book_image_pom;
  }

  public function getBookDescr(){
    return $this->book_descr;
  }
  public function setBookDescr($book_descr_pom){
    $this->book_descr=$book_descr_pom;
  }

  public function getBookPrice(){
    return $this->book_price;
  }
  public function setBookPrice($book_price_pom){
    $this->book_price=$book_price_pom;
  }


  public function getPublisherID(){
    return $this->publisherid;
  }
  public function setPublisherID($publisherid_pom){
    $this->publisherid=$publisherid_pom;
  }


    public function getCategoryID(){
      return $this->categoryid;
    }
    public function setCategoryID($categoryid_pom){
      $this->categoryid=$categoryid_pom;
    }
}

 ?>
