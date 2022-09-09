<?php

class Session
{

    public static $sid;
    private static $instance = null;

    private function __construct()
    {
        if( session_status() !== PHP_SESSION_ACTIVE ) {
            session_start();
        }
        self::$sid = session_id();
    }

    public static function get_instance(){
        if( self::$instance === null ){
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function start(){
        return self::get_instance();
    }

    public static function refresh(){
        self::get_instance();
        session_regenerate_id();
    }

    public static function get_session_id()
    {
        return self::$sid;
    }

    public function set( $key, $value )
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    public function get( $key )
    {
        return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
    }

    public function destroy()
    {
        session_destroy();
    }

}
