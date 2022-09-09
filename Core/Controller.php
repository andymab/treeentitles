<?php

class Controller
{

    public $Views;
    public $Session;
    public $Access;

    // reflection class
    private $rc = null;

    private $action_class = null;

    public function __construct()
    {
        $this->Views = new \Views( $this );
        $this->Views->set_template_dir( $this->get_current_dir() . "/views" );
        
        $this->Session = \Session::get_instance();
        $this->Access = new \Access;

        $userPasswd = filter_input( INPUT_POST, 'userPassword' );
        $userEmail = filter_input( INPUT_POST, 'userEmail' );

        if( $userPasswd AND $userEmail ) {
            \Access::set_user( $userPasswd, $userEmail );
        } else {
            \Access::set_user();
        }
    }

    public function get_current_dir()
    {
        if($this->rc === null){
            $this->rc = new \ReflectionClass( $this );
        }
        return dirname( $this->rc->getFileName() );
    }


    /**
     * Вызывает метод контроллера, если он есть
     * @param string $action Название метода
     * @param mixed $params Параметры, передающиеся в метод
     */
    public function exec( $action, $params = [] ){
        if( $this->has_method( $action ) ){
            call_user_func_array( [$this, $action], is_array( $params ) ? $params : [$params] );
        }
    }

    /**
     * Есть ли в контроллере такой метод?
     * @param string $method_name Имя метода
     * @return boolean
     */
    public function has_method( $method_name ){
        return method_exists( $this, $method_name );
    }
    
    function set_action_class( $class ){
        $this->action_class = $class;
    }

    public function action( $action ){
        if( !$this->action_class ){
            return;
        }

        $class = new $this->action_class;
        if( !method_exists( $class, $action ) ) {
            echo json_encode( \Sfn::message( false, 'метод в классе ' . get_class( $class ) . '->' . $action . ' не обнаружен' ) );
        } else {
            echo json_encode( $class->$action() );
        }
    }

}
