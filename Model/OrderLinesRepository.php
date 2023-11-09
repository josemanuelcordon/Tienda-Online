<?php
class OrderLinesRepository
{
    public static function getOrderLines($order_id)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM orderLines WHERE idOrder=" . $order_id;
        $result = $bd->query($q);
        $orderLines = [];
        while ($datos = $result->fetch_assoc()) {
            $orderLines[] = new OrderLines($datos);
        }
        return $orderLines;
    }
}
