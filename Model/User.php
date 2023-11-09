<?php
class User
{
    private $id;
    private $username;
    private $rol;
    private $address;

    private $cart;

    public function __construct($datos)
    {
        $this->id = $datos['id'];
        $this->username = $datos['username'];
        $this->rol = $datos['rol'];
        $this->address = $datos['address'];
        $this->cart = OrderRepository::getUserCart($this->id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function getOrders()
    {
        return OrderRepository::getUserOrders($this->id);
    }
}
