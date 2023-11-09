<?php
require_once("Model/ArticleClass.php");
require_once("Model/UserClass.php");
require_once("Model/CommentClass.php");
require_once("Model/ArticleRepository.php");
require_once("Model/UserRepository.php");
require_once("Model/CommentRepository.php");

session_start();


if (!empty($_GET['controller'])) {
    $controlador = $_GET['controller'];
}

include('View/mainView.phtml');
