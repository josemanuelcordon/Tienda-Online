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
$controllers = ['user', 'product', 'order', 'api'];

if (!empty($_GET['c'])) {
    $controlador = $_GET['c'];
    if (in_array($controlador, $controllers)) {
        require($controlador . "Controller.php");
    }
}

if (!empty($_SESSION['user'])) {
    $products = ProductRepository::getProductsLimited(0, 6);
    $linksNumber = ceil(ProductRepository::getAmountProducts() / 6);
    $orders = $_SESSION['user']->getOrders();
    include('View/mainView.phtml');
} else {
    include('View/loginView.phtml');
}
