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
        $q = "SELECT * FROM orderlines WHERE idOrder=" . $id_order . " AND idProduct=" . $id_product;
        $result = $bd->query($q);
        if ($result->num_rows > 0) {
            $q = "UPDATE orderlines SET amount=amount+" . $amount . "  WHERE idOrder=" . $id_order . " AND idProduct=" . $id_product;
        } else {
            $q = "INSERT INTO orderlines VALUES (NULL, " . $id_order . ", " . $id_product . ", " . $amount . ", " . $price . ")";
        }
        $bd->query($q);
    }

    public static function deleteItemFromCart($id_order, $id_product)
    {
        $bd = Conectar::conexion();
        $q = "DELETE FROM orderlines WHERE idOrder=" . $id_order . " AND idProduct=" . $id_product;
        $bd->query($q);
    }
}
