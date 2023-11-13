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

    public static function addToCartById($id_order, $id_product, $amount, $price)
    {
        $bd = Conectar::conexion();
        $q = "INSERT INTO orderlines VALUES (NULL, " . $id_order . ", " . $id_product . ", " . $amount . ", " . $price . ")";
        $bd->query($q);
        $q = "SELECT stock FROM product WHERE id=" . $id_product;
        $result = $bd->query($q);
        $stock = $result->fetch_array()[0];
        $q = "UPDATE product SET stock=" . ($stock - $amount) . " WHERE id=" . $id_product;
        $bd->query($q);
    }
}
