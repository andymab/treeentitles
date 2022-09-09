<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );

require( '.conf.php');

require_once('Core/Autoloader.php');
Autoloader::SetDestination( 'Controllers/' );
Autoloader::SetDestination( 'Core/' );
spl_autoload_register( ['Autoloader', 'Autoload'] );

//require __DIR__ . '/vendor/autoload.php';

Session::start();

list( $controllerName, $method, $parameter ) = array_pad( explode( "/", $_GET['action'] ?? "home_/index" ), 3, null );

if( $controllerName === 'exit' ) {
    Session::refresh();
    header( "Location: /" );
    exit;
}

if( !file_exists( rPATH . "/controllers/{$controllerName}/controller.php" ) ) {
    echo "Не найден контроллер '{$controllerName}'";
    die;
}

require_once(rPATH . "/controllers/{$controllerName}/controller.php" );

$controller = "\\{$controllerName}\\{$controllerName}";

$controller_instance = new $controller;

if( !$method ) {
    $method = 'index';
}

if( !$parameter ) {
    $parameter = null;
}

if( $controller_instance->has_method( $method )) {
    //когда обнаружен метод теперь стоит проверить
    //есть ли доступ у пользователя
    $access = true;

    if( isset( $controller_instance->access ) ) {
        $access = \Access::access( $method, $controller_instance->access,$parameter );
    }

    if( $access ) { //если есть доступ
        $controller_instance->exec( $method, $parameter );
    } else {
        //авторизация
        $controller_instance->Views->render( '/login' );
    }
} else {
    echo "В контроллере '{$controllerName}' отсутствует метод '{$method}'";
}