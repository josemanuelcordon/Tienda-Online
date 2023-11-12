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

if (isset($_POST['changeRol'])) {
    $rol = $_POST['rol'];
    $userId = $_POST['id'];
    UserRepository::changeRol($userId, $rol);
}

if (!empty($_GET['lo'])) {
    session_destroy();
    session_start();
}

if (!empty($_GET['admin'])) {
    $users = UserRepository::getAllUsers();
    include('View/adminView.phtml');
    die;
}

if (!empty($_GET['register'])) {
    include('View/registerView.phtml');
    die;
}
