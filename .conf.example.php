<?php
/** @var rPATH global PATH */
@define('rPATH', $_SERVER['DOCUMENT_ROOT']);
@define('DB_NAME', 'treecomp');
@define('DB_USER', 'mysql');
@define('DB_PSWD', 'mysql');
@define('DB_HOST', 'localhost');
@define('DB_CHARSET', 'utf8');
@define('IS_HOST', "http://" . $_SERVER['HTTP_HOST'] . '/');
@define('IS_CONFIG_SALT', 'mabTree@l#!mab');

date_default_timezone_set('Europe/Moscow');