<?php

class Views
{

    public $model;
    private $controller;
    private $template_dir = rPATH . "/Views";

    public function __construct( $controller )
    {
        $this->controller = $controller;
    }

    function set_template_dir( $dir ){
        $this->template_dir = $dir;
    }

    /**
     * Привязка дополнительных link/scripts к текущему шаблону
     * @param array $file_array Массив путей к файлам js/css
     * @param string $resource_type Тип ресурса script/style
     * @return string Строка содержащая html-разметку скриптов/стилей
     */
    public function getaddscripts( $file_array, $resource_type )
    {
        $items = [];
        foreach( $file_array as $file ) {
            if( $resource_type == 'style' ) {
                $items[] = "<link rel=\"stylesheet\" href=\"{$file}\" >";
            } else if( $resource_type == 'script' ) {
                $items[] = "<script type=\"text/javascript\" src=\"{$file}\"></script>";
            }
        }

        return implode( "\n", $items );
    }

    /**
     * Отрисовка шаблона и вывод его на экран
     * @param string $template Путь к шаблону относительно текущего контроллера и папки Views в нем
     * @param mixed $model Любые данные
     */
    public function render( $template, $model = '' )
    {

        if( $model !== null ) {
            $this->model['data'] = $model;
        }

        if( substr( $template, 0, 1 ) == '/' ) {
            $template_file = rPATH . "/views{$template}.tpl.php";
        } else {
            $template_file = "{$this->template_dir}/{$template}.tpl.php";
        }

        if( !file_exists( $template_file ) ) {
            return "отсутствует файл представления tpl: {$template}";
        }

        ob_start();
            require ( $template_file );
        $content = ob_get_clean();

        if( isset( $css ) ) {
            $css = $this->getaddscripts( $css, 'style' );
        }
        if( isset( $js ) ) {
            $js = $this->getaddscripts( $js, 'script' );
        }

        if( isset( $layout ) ) {
            $layout_file = rPATH . "/views/{$layout}.tpl.php";
            if( !file_exists( $layout_file ) ) {
                echo 'отсутствует основное представление';
            }
            require $layout_file;
        } else {
            echo $content;
        }
    }

    public function xml( $f )
    {
        if( !isset( $f['tpl'] ) || ! isset( $f['path'] ) ) {
            return 'не передан tpl или path';
        }

        if( !file_exists( "{$f['path']}/views/{$f['tpl']}.tpl.php" ) ) {
            return 'отсутствует файл представления tpl : ' . $f['tpl'];
        }

        if( isset( $f['data'] ) ){
            $this->model['data'] = $f['data'];
        }

        require "{$f['path']}/views/{$f['tpl']}.tpl.php";

    }

}
