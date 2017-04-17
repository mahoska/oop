<?php 
error_reporting(E_ALL);
require_once 'includes/functions.php';
$link = db_connect('localhost', 'root', '', 'mvc_17_03');
mysqli_query($link,"SET NAMES utf8")or exit("SET NAMES Error");

define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);

session_start();
$page = requestGet('page','books');
$controllerPath = ROOT.'controllers'.DIRECTORY_SEPARATOR.$page.'_controller.php';
if(!file_exists($controllerPath)){
    http_response_code(404);
    $page = 'error';
    $controllerPath = ROOT.'controllers'.DIRECTORY_SEPARATOR.$page.'_controller.php';
}
require_once $controllerPath;
$template = ROOT.'templates'.DIRECTORY_SEPARATOR.$page.'_template.php';

ob_start();//открывает буфер вывода
require_once $template;
$content = ob_get_clean();//достает то что накопилось в буфере и очищает его

$date = date("Y");

require_once 'templates/layout_template.php';
