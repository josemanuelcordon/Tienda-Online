<?php
class Order
{
    private $id;
    private $orderLines;
    private $date;
    private $totalPrice;
    private $status;
    public function __construct($datos)
    {
        $this->id = $datos['id'];
        $this->orderLines = OrderLinesRepository::getOrderLines($this->id);
        $this->date = $datos['date'];
        $this->status = $datos['status'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOrderLines()
    {
        return $this->orderLines;
    }

    public function getDate()
    {
        return $this->date;
    }



    public function getStatus()
    {
        return $this->status;
    }

    public function updateLines()
    {
        $this->orderLines = OrderLinesRepository::getOrderLines($this->id);
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->orderLines as $orderLine) {
            $totalPrice += $orderLine->getPrice() * $orderLine->getAmount();
        }
        return $totalPrice;
    }
}
