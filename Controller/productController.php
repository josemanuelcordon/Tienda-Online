<?php

if (!empty($_POST['create'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $img = 'assets/img/' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $img);
    $price = $_POST['price'];
    $amount = $_POST['amount'];
    ProductRepository::createProduct($name, $description, $price, $img, $amount);
}

if (!empty($_GET['cp'])) {
    include('View/productView.phtml');
    die;
}
