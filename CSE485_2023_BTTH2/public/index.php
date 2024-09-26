<?php
function cleanInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

$controller = isset($_GET['controller']) ? cleanInput($_GET['controller']) : 'Home';
$controllerName = ucfirst($controller) . 'Controller';
$controllerPath = "../app/controllers/$controllerName.php";

if (!file_exists($controllerPath)) {
    die('Controller không tồn tại');
}

require_once $controllerPath;

if (!class_exists($controllerName)) {
    die('Class không tồn tại');
}

$myController = new $controllerName();

$action = isset($_GET['action']) ? cleanInput($_GET['action']) : 'index';

if (!method_exists($myController, $action)) {
    die('Action không tồn tại');
}

$myController->$action();
?>