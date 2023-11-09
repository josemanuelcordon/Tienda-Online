<?php
class Product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $img;
    private $stock;
    private $state;

    public function __construct($datos)
    {
        $this->id = $datos["id"];
        $this->name = $datos["name"];
        $this->description = $datos["description"];
        $this->price = $datos["price"];
        $this->img = $datos["img"];
        $this->stock = $datos["stock"];
        $this->state = $datos["state"];
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getImg() {
        return $this->img;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getState() {
        return $this->state;
    }
}
