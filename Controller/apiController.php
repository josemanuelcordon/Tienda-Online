<?php
if (isset($_GET['start'])) {

    $offset = $_GET['start'];
    $limit = $offset + 6;
    $json = [];
    $products = ProductRepository::getProductsLimited($offset, $limit);
    foreach ($products as $product) {
        $json[] = $product->getJSON();
    }

    echo json_encode($json);
    die;
}
