<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['user'] = UserRepository::checkLogin($username, $password);
}



if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $registerSuccess = UserRepository::registerUser($username, $password, $address);
    if ($registerSuccess) {
        include('View/loginView.phtml');
        die;
    }
}


if (!empty($_GET['register'])) {
    include('View/registerView.phtml');
    die;
}
