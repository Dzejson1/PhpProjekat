<?php
/**
 *
 */

 require_once("classes/Item.php");
class Cart
{
  private $id;
  private $items=array();
  private $date;

  function __construct()
  {



  }

  public function getItemForIsbn($isbn){
    foreach ($this->items as $item) {
      if($item->getIsbn()==$isbn){
        return $item;
      }
    }
  }

  public function getIsbns(){
    $isbns=array();
    foreach ($this->items as $item) {
      $isbns[]=$item->getIsbn();
    }
    return $isbns;
  }

  public function removeBookFromCart($isbn){
    $pom=0;
    foreach ($this->items as $item) {
      if($item->getIsbn()==$isbn){
        unset($this->items[$pom]);
        break;
      }
      $pom++;
    }
  }



    /**
     * Get the value of Items
     *
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }






    /**
     * Set the value of Items
     *
     * @param mixed $items
     *
     * @return self
     */
    public function setItems($item)
    {
        $this->items[] = $item;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }






    /**
     * Set the value of Items
     *
     * @param mixed $items
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id= $id;

        return $this;
    }


    public function getDate()
    {
        return $this->date;
    }






    /**
     * Set the value of Items
     *
     * @param mixed $items
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->date= $date;

        return $this;
    }

}


 ?>
