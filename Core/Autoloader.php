<?php

class Autoloader
{
    #region реализация закрытого Singleton

    private static $instance;

    public static function GetInstance()
    {
        if( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    #endregion

    private $destinations = array();
    private $lastLoadDeclaredClasses = null;
    private $loadedPackages = array();

    private function __construct()
    {
        $this->AddDestination( '' );
    }

    public static function SetDestination( $destination, $namespace = '' )
    {
        self::GetInstance()->AddDestination( $destination, $namespace );
    }

    public static function Autoload( $type )
    {
        return self::GetInstance()->RequireType( $type );
    }

    private static function preparePath( $path )
    {
        $path = str_replace( '\\', '/', $path );
        $parts = explode( '/', $path );

        $result = [];

        $basePath = $_SERVER['DOCUMENT_ROOT'];

        foreach( $parts as $dirtyPart ) {
            $parhForAdded = $dirtyPart;

            if( !file_exists( $basePath ) )
                break;

            foreach( scandir( $basePath ) as $location ) {
                if( strtolower( $dirtyPart ) == strtolower( $location ) ) {
                    $parhForAdded = $location;
                    break;
                }
            }
            $basePath .= '/' . $parhForAdded;
        }



        if( is_file( $basePath ) ) {
            $result[] = $basePath;
        }

        return $result;
    }

    public function RequireType( $type )
    {

        if( !class_exists( $type ) && !interface_exists( $type ) ) {
            return $this->FindType( $type );
        }

        return false;
    }

    public function RequireFile( $path, $type )
    {
        if( $this->lastLoadDeclaredClasses === null ) {
            $this->lastLoadDeclaredClasses = get_declared_classes();
        }

        if( file_exists( $path ) ) {
            require_once $path;

            $newLoadDeclaredClasses = get_declared_classes();

            $this->lastLoadDeclaredClasses = $newLoadDeclaredClasses;
        }

        return class_exists( $type ) || interface_exists( $type ) ? true : false;
    }

    protected function LoadPackages()
    {
        if( isset( $this->destinations[''] ) ) {
            $newDirections = array();
            foreach( $this->destinations[''] as $destination ) {
                if( empty( $this->loadedPackages[$destination] ) ) {
                    $this->loadedPackages[$destination] = true;
                }
            }

            foreach( $newDirections as $namespace => $dir ) {
                $this->AddDestination( $dir, $namespace );
            }
        }
    }

    protected function FindType( $type )
    {

        $this->LoadPackages();
        $paths = [];

        foreach( $this->destinations as $namespace => $destinations ) {
            foreach( $destinations as $destination ) {
                $trimType = $type;

                if( $namespace && strpos( $trimType, $namespace ) === 0 ) {
                    $trimType = substr( $trimType, strlen( $namespace ) );
                }

                $paths = array_merge( $paths, self::preparePath( $destination . "$trimType.php" ) );
            }
        }


        foreach( $paths as $path ) {

            if( file_exists( $path ) ) {

                $this->RequireFile( $path, $type );

                if( class_exists( $type ) || interface_exists( $type ) ) {
                    return true;
                }
            }
        }
        return false;
    }

    public function AddDestination( $destination, $namespace = '' )
    {
        $this->destinations[$namespace][] = $destination;
    }

}
