<?php
class ProductRepository
{
    public static function getProductById($id_product)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM product WHERE id=" . $id_product;
        $result = $bd->query($q);
        $product = null;
        if ($result->num_rows > 0) {
            $product = $result->fetch_array()[0];
        }

        return $product;
    }

    public static function getProductsLimited($offset, $limit)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM product LIMIT " . $offset . ", " . $limit;
        $result = $bd->query($q);
        $products = [];
        while ($datos = $result->fetch_assoc()) {
            $products[] = new Product($datos);
        }
        return $products;
    }

    public static function createProduct($name, $description, $price, $img, $amount)
    {
        $bd = Conectar::conexion();
        $q = "INSERT INTO product VALUES (NULL, '" . $name . "', '" . $description . "', " . $price . ", '" . $img . "' , " . $amount . ", 1)";
        $bd->query($q);
    }

    public static function getStock($id_product)
    {
        $bd = Conectar::conexion();
        $q = "SELECT stock FROM product WHERE id=" . $id_product;
        $result = $bd->query($q);
        $stock = $result->fetch_array()[0];
        return $stock;
    }

    public static function getPriceById($id_product)
    {
        $bd = Conectar::conexion();
        $q = "SELECT price FROM product WHERE id=" . $id_product;
        $result = $bd->query($q);
        $price = $result->fetch_array()[0];
        return $price;
    }
}
