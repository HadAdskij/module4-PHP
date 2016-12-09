<?php

require_once 'settings.php';
require_once 'includes.php';

session_start();

if (isset($_POST['logout'])) {
    $_SESSION['user'] = NULL;
    session_destroy();
}

$message = NULL;

if (isset($_POST['pass']) && isset($_POST['login']))
{
    if (!$_POST['pass'] && !$_POST['login'])
        $message = "Введіть логін та пароль!";
    else
        {
        $userObj = new \Controller\UserController($message);
        $_SESSION['user'] = $userObj->validate($_POST['login'], $_POST['pass'], $isAdmin);
        if (isset($isAdmin))
            $_SESSION['admin'] = 1;
        if (!$_SESSION['user'])
            $message = "Невірний логін чи пароль!";
        }
}

$controller = 'Index';
$action = 'index';
$parameters = null;

if( isset($_GET['route'])) {
    $route = explode('/', $_GET['route']);
    if(isset($route[0])) {
        $controller = ucfirst($route[0]);
    }
    if(isset($route[1])) {
        $action = $route[1];
    }
    if(isset($route[2])) {
        $parameters = $route[2];
    }
}

$controllerName = "\\Controller\\{$controller}Controller";
if (class_exists($controllerName))
    $controllerObj = new $controllerName($message);
if(class_exists($controllerName) && is_callable(array($controllerObj, $action))) {
    $controllerObj->$action($parameters);
} else {
    $controllerName = "\\Controller\\BaseController";
    $controllerObj = new $controllerName($message);
    $controllerObj->render404();
}

