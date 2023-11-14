<?php
class OrderRepository
{
    public static function getUserCart($user_id)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM cart WHERE id_user=" . $user_id . " AND status=0";
        $result = $bd->query($q);
        $cart = null;
        if ($result->num_rows > 0) {
            $datos = $result->fetch_assoc();
            $cart = new Order($datos);
        }
        return $cart;
    }

    public static function getUserOrders($user_id)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM cart WHERE id_user=" . $user_id . " AND status=1";
        $result = $bd->query($q);
        $orders = [];
        while ($datos = $result->fetch_assoc()) {
            $orders[] = new Order($datos);
        }
        return $orders;
    }

    public static function createCart($user_id)
    {
        $bd = Conectar::conexion();
        $fecha = date("Y-m-d H:i:s");
        $q = "INSERT INTO cart VALUES (NULL, '" . $fecha . "', 0, " . $user_id . ")";
        $result = $bd->query($q);
        $q = "SELECT * FROM cart WHERE id_user=" . $user_id . " AND status=0";
        $result = $bd->query($q);
        $cart = new Order($result->fetch_assoc());
        return $cart;
    }

    public static function confirmOrder($order_id)
    {
        $bd = Conectar::conexion();
        $q = "UPDATE cart SET status=1 WHERE id=" . $order_id;
        return $bd->query($q);
    }
}
