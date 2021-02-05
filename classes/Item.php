<?php
/**
 *
 */
class Item
{
  private $isbn;
  private $name;
  private $price;
  private $quantity;
  private $total;
  private $image;
  private $cartId; 

  function __construct($isbn,$name,$price,$quantity,$total)
  {
    $this->isbn=$isbn;
    $this->name=$name;
    $this->price=$price;
    $this->quantity=$quantity;
    $this->total=$total;
  }
  public function getIsbn()
  {
      return $this->isbn;
  }

  /**
   * Set the value of Name
   *
   * @param mixed $name
   *
   * @return self
   */
  public function setIsbn($isbn)
  {
      $this->isbn = $isbn;

      return $this;
  }

  public function getImage()
  {
      return $this->image;
  }

  /**
   * Set the value of Name
   *
   * @param mixed $name
   *
   * @return self
   */
  public function setImage($image)
  {
      $this->image = $image;

      return $this;
  }


    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Price
     *
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of Price
     *
     * @param mixed $price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of Quantity
     *
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of Quantity
     *
     * @param mixed $quantity
     *
     * @return self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of Total
     *
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of Total
     *
     * @param mixed $total
     *
     * @return self
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

}

 ?>
