<?php
require_once("Model/Order.php");
require_once("Model/OrderRepository.php");
require_once("Model/OrderLines.php");
require_once("Model/OrderLinesRepository.php");
require_once("Model/Product.php");
require_once("Model/ProductRepository.php");
require_once("Model/User.php");
require_once("Model/UserRepository.php");

session_start();
$products = [];

if (!empty($_GET['c'])) {
    $controlador = $_GET['c'];
    if ($controlador = "user") {
        require($controlador . "Controller.php");
    }
}

if (!empty($_SESSION['user'])) {
    $products = ProductRepository::getProductsLimited(0, 6);
    include('View/mainView.phtml');
} else {
    include('View/loginView.phtml');
}
