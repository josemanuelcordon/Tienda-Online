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
        $q = "SELECT * FROM order WHERE id_usuario=" . $user_id;
        $result = $bd->query($q);
        $orders = [];
        while ($datos = $result->fetch_assoc()) {
            $orders[] = new Order($datos);
        }
        return $orders;
    }
}
