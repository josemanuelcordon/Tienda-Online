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


if (!empty($_GET['controller'])) {
    $controlador = $_GET['controller'];
}

include('View/mainView.phtml');
