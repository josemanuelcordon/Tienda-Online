<?php
class OrderLines
{
    private $id;
    private $idOrder;
    private $product;
    private $amount;
    private $price;

    public function __construct($datos)
    {
        $this->id = $datos["id"];
        $this->idOrder = $datos["idOrder"];
        $this->product = ProductRepository::getProductById($datos['idProduct']);
        $this->amount = $datos["amount"];
        $this->price = $datos["price"];
    }

    public function getOrder()
    {
        return $this->id;
    }

    public function getIdOrder()
    {
        return $this->idOrder;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
