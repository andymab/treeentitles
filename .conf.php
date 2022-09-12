<?php
/** @var rPATH global PATH */
$http = !empty($_SERVER['HTTPS']) && 'off' !== strtolower($_SERVER['HTTPS']) ? "https://" : "http://";

@define('rPATH', $_SERVER['DOCUMENT_ROOT']);
@define('DB_NAME', 'treecomp');
@define('DB_USER', 'mysql');
@define('DB_PSWD', 'mysql');
@define('DB_HOST', 'localhost');
@define('DB_CHARSET', 'utf8');
@define('IS_HOST', $http . $_SERVER['HTTP_HOST'] . '/');
@define('IS_CONFIG_SALT', 'mabTree@l#!mab');

date_default_timezone_set('Europe/Moscow');

require_once('Core/Autoloader.php');
Autoloader::SetDestination('Controllers/');
Autoloader::SetDestination('Core/');
spl_autoload_register(['Autoloader', 'Autoload']);