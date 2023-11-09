<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['user'] = UserRepository::checkLogin($username, $password);
}
