<?php

namespace home_;

class Home_ extends \Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function Index()
    {
        $this->Views->render( 'index' );
    }


}
