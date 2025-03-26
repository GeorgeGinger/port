<?php
session_start();
include "../app/init.php";

define('ROOTPATH',__DIR__ . DIRECTORY_SEPARATOR);

$path = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];
$path = str_replace("index.php", "", $path);

define("ROOT", $path);
define("ASSETS", $path . "assets/");

$app = new App();