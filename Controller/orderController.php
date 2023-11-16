<?php
if (!empty($_POST['id'])) {
    $cart = $_SESSION['user']->getCart();
    $productId = $_POST['id'];
    $amount = $_POST['amount'];
    if (!empty($_SESSION['confirmed'])) {
        $_SESSION['confirmed'] = null;
    }
    $price = ProductRepository::getPriceById($productId);
    $isAvailable = ProductRepository::isAvailable($productId, $amount);
    if (!empty($cart) && $isAvailable) {
        $idOrder = $cart->getId();
        OrderLinesRepository::addToCartById($idOrder, $productId, $amount, $price);
        $_SESSION['user']->getCart()->updateLines();
    } elseif ($isAvailable) {
        $_SESSION['user']->setCart(OrderRepository::createCart($_SESSION['user']->getId()));
        $idOrder = $_SESSION['user']->getCart()->getId();
        OrderLinesRepository::addToCartById($idOrder, $productId, $amount, $price);
        $_SESSION['user']->getCart()->updateLines();
    }
}

if (!empty($_GET['confirm'])) {
    $cart = $_SESSION['user']->getCart();
    $areAvailable = true;
    $_SESSION['delProd'] = [];
    $_SESSION['confirmed'] = null;
    foreach ($cart->getOrderLines() as $line) {
        $idProduct = $line->getProduct()->getId();
        $amount = $line->getAmount();
        if (!ProductRepository::isAvailable($idProduct, $amount)) {
            $areAvailable = false;
            $_SESSION['delProd'][] = ProductRepository::getProductById($idProduct);
        }
    }
    if ($areAvailable && $cart) {
        $_SESSION['confirmed'] = OrderRepository::confirmOrder($cart->getId());
        ProductRepository::calcNewStock($cart);
        $_SESSION['user']->setCart(null);
    }
    header('location: index.php');
}

if (!empty($_GET['id'])) {
    $idProduct = $_GET['id'];
    $cart = $_SESSION['user']->getCart();
    OrderLinesRepository::deleteItemFromCart($cart->getId(), $idProduct);
    $_SESSION['user']->getCart()->updateLines();
}

if (!empty($_GET['orders'])) {
    $orders = $_SESSION['user']->getOrders();
    include('View/allOrdersView.phtml');
    die;
}

if (!empty($_GET['cart'])) {
    $cart = $_SESSION['user']->getCart();
    if (!empty($_SESSION['delProd'])) {
        $_SESSION['delProd'] = null;
    }
    include('View/cartView.phtml');
    die;
}
