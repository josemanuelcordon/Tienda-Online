<?php
class ProductRepository
{
    public static function getProductById($id_product)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM product WHERE id=" . $id_product;
        $result = $bd->query($q);
        $product = null;
        $data = $result->fetch_assoc();
        $product = new Product($data);

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

    public static function isAvailable($id_product, $cantidad)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM product WHERE id=" . $id_product . " AND stock>= " . $cantidad;
        $result = $bd->query($q);
        return $result->num_rows > 0;
    }

    public static function calcNewStock($cart)
    {
        $lines = $cart->getOrderLines();
        $bd = Conectar::conexion();
        foreach ($lines as $line) {
            $amount = $line->getAmount();
            $idProduct = $line->getProduct()->getId();
            $q = "UPDATE product SET stock=stock-" . $amount . " WHERE id=" . $idProduct;
            $bd->query($q);
        }
    }

    public static function getAmountProducts()
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM product";
        $result = $bd->query($q);
        return $result->num_rows;
    }
}
