<?php
class ProductRepository
{
    public static function getProductById($id_product)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM products WHERE id=" . $id_product;
        $result = $bd->query($q);
        $product = null;
        if ($result->num_rows > 0) {
            $product = $result->fetch_array()[0];
        }

        return $product;
    }
}
