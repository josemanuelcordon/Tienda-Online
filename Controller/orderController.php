<?php
if (!empty($_POST['id'])) {
    $cart = $_SESSION['user']->getCart();
    $productId = $_POST['id'];
    $amount = $_POST['amount'];
    $price = ProductRepository::getPriceById($productId);
    if (!empty($cart)) {
        $idOrder = $cart->getId();
        OrderLinesRepository::addToCartById($idOrder, $productId, $amount, $price);
    } else {

        $_SESSION['user']->setCart(OrderRepository::createCart($_SESSION['user']->getId()));
        $idOrder = $_SESSION['user']->getCart()->getId();
        OrderLinesRepository::addToCartById($idOrder, $productId, $amount, $price);
    }

    $_SESSION['user']->getCart()->updateLines();
}

if (!empty($_GET['cart'])) {
    $cart = $_SESSION['user']->getCart();
    include('View/cartView.phtml');
    die;
}
