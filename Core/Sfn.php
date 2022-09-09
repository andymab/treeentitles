<?php

//helper

class Sfn {

    public static $memory;
    public static $time;


    static public function DateTimeString($datef, $format) {
        //$format = 'm/d/Y'
        //date = '01/12/2016'
        $date = \DateTimeImmutable::createFromFormat($format, $datef);
        return $date->format('Y-m-d');
    }

#region находки

    static function allRows($rows) {
        //это просто чтобы не забыть применить когда нужно преобразовать весь массив строк
        array_walk($rows, function($row) {
            $date = \DateTimeImmutable::createFromFormat('m/d/Y', $row['created_date']);
            $row['created_date'] = $date->format('Y-m-d');
        });
    }

    static function status($param) {
        if ($param['status'] == 'success') {
            return true;
        }
        return false;
    }

////////////////////////////////////////////////////////////////////////

    /**
     * 
     * @param array $array исследуемый массив
     * @param array $must карта по которой исследуем
     * @return boolean при ошибке возвращаем true
     */
    static function must_be($array, $must) {
        $keys = array_keys($must);
        foreach ($keys as $key) {
            if (!isset($array[$key]) || $array[$key] === false) {
                return true;
            }
        }
    }

    /**
     * 
     * @param array $array иссследуемый массив
     * @param array $must карта по которой исследуем
     * @return boolean при ошибке возврашщаем true
     */
    static function isset_be($array, $must) {
        $keys = array_keys($must);
        foreach ($keys as $key) {
            if (!isset($array[$key])) {
                return true;
            }
        }
    }

//////////////////////////////////////////////////////////////////////////////////////

    static function str_to_mname($str) {
        return mb_strtolower(preg_replace("/[^a-zA-Zа-яА-Я0-9]/ui", "", $str), "UTF-8");
    }

//////////////////////////////////////////////////////////////////////////////////////

    static public function str_to_ru_mname($str) { ////убрать Оставить только русские буквы
        return preg_replace("/[^а-яА-Я]/ui", "", $str);
    }

///////////////////////////////////////////////////////////////////////////////////

    static public function cnt_russian_letter($str) { ////Количество русских букв
        if (!is_string($str)) {
            return 'error: this is not string';
        }
        return mb_strlen(self::str_to_ru_mname($str), 'utf8');
    }

//////////////////////////////////////////////////////////////////////////////////////

    static public function str_to_numbers($str) { ////убратьОставить только цифры
        return preg_replace("/[^0-9]/", "", $str);
    }

//////////////////////////////////////////////////////////////////////////////////////

    static public function str_to_letters($str) {//убрать
        return mb_strtolower(preg_replace("/[^a-zA-Zа-яА-Я]/ui", "", $str), "UTF-8");
    }

//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

    static public function from_mktime($d) { ////убрать ?? timestamp ? 13.02.2012
        if ($d == null or trim($d) == '0') {
            return '-';
        }
        return date("j.m.Y", $d);
    }

//////////////////////////////////////////////////////////////////////////////////////

    /**
     * 
     * @param string $d 13.12.2012
     * @return timestamp 
     *     
     */
    static public function to_mktime($d) {  //?? 13.02.2012 ? timestamp 
//переписать через //date('d.m.y H:i',strtotime( $str ))
        if (substr_count($d, '.') != 2) {
            return null;
        }
        $dat = explode(".", $d);
        //$tm  = getdate( time());
        return mktime(0, 0, 0, intval($dat[1]), intval($dat[0]), intval($dat[2]));
    }

//////////////////////////////////////////////////////////////////////////////////////

    static public function pre($str_or_arr, $out_type = "print_r") {//убрать
        echo '<pre>';
        if ($out_type == "print_r") {
            print_r($str_or_arr);
        } elseif (in_array($out_type, ["vd", "var_dump"])) {
            var_dump($str_or_arr);
        }
        echo '</pre>';
    }

    static public function _console() {
        //    self::$console_mode = true;
        echo "<pre>";
        # Internal Server Error fix in case no apache_setenv() function exists
        if (function_exists('apache_setenv')) {
            apache_setenv('no-gzip', 1);
        }
        ini_set('zlib.output_compression', 0);
        ini_set('implicit_flush', 1);
        for ($i = 0; $i < ob_get_level(); $i++) {
            ob_end_flush();
        }
        ob_implicit_flush(1);

        # writing debug
        //	echo "# Console mode activated\n";
        //   self::add_debug_msg("# Console mode activated");
    }

    static function translit_rus_to_eng($str) {
        $tr = array(
            "а" => "a", "А" => "A", "с" => "c", "С" => "C", "е" => "e", "Е" => "E", "Т" => "T", "Н" => "H", "о" => "o", "О" => "O", "р" => "p", "Р" => "P", "к" => "k", "К" => "K", "х" => "x", "Х" => "X", "В" => "B", "М" => "M", "ь" => "b", "г" => "r", "у" => "y", "У" => "Y"
        );
        return strtr($str, $tr);
    }

    static function header404_page() {
        header('HTTP/1.1 404 Not Found');
        echo file_get_contents(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/views/404.html');
        die;
        //require 'error.php';
    }

    static function header301($path = '') { //возможно переписать куда редирект
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: http://" . filter_input(INPUT_SERVER, 'HTTP_HOST') . $path);
        die;
    }

    static function translit_eng_to_rus($str) {
        $tr = array(
            "а" => "a", "А" => "A", "с" => "c", "С" => "C", "е" => "e", "Е" => "E", "Т" => "T", "Н" => "H", "о" => "o", "О" => "O", "р" => "p", "Р" => "P", "к" => "k", "К" => "K", "х" => "x", "Х" => "X", "В" => "B", "М" => "M", "ь" => "b", "г" => "r", "у" => "y", "У" => "Y"
        );
        $tr_naoborot = array_flip($tr);
        return strtr($str, $tr_naoborot);
    }

    /**
     * 
     * @param type $s title
     * @param type $m message
     * @param type $d array 
     * @return type  array('status','message',data[])
     */
    static function message($s, $m, $d = null) {
        $arr = [];
        $arr['status'] = $s ? 'success' : 'error';
        $arr['message'] = $m ? $m : 'error';
        if ($d !== null) {
            $arr['data'] = $d;
        }
        return $arr;
    }

    static function is_url($str) { ////убратьпередаем любую строчку, если это юрл - то вернет 1.
        $arr = parse_url(trim($str));
        if (array_key_exists('scheme', $arr) && ($arr['scheme'] == 'http' || $arr['scheme'] == 'https')) {
            return true;
        }

        return false;
    }

    ////////////////////////////
    static function get_map_table($table_name) {
        $map = "$" . $table_name . ' = [';
        include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/.cfg40050.php';
        $db = \connect::_self()->mysql();
        $cols = $db->query('SHOW COLUMNS FROM `' . ($table_name) . '`')->fetchall();
        foreach ($cols as $col) {
            if (self::str_to_letters($col->Type) == 'int') {
                $map .= "'" . $col->Field . "'=>\PDO::PARAM_INT, ";
            } else {
                $map .= "'" . $col->Field . "'=>\PDO::PARAM_STR, ";
            }
        }

        return ($map . "];");
    }

    static function timer_start() {
        self::$memory = memory_get_usage();
        self::$time = microtime(true);
    }

    static function timer_show() {
        $time = sprintf('%f секунд <br/>', microtime(true) - self::$time);
        $memory = number_format(memory_get_usage() - self::$memory, 0, '.', ' ') . ' bytes';
        echo '<pre>' . $time . "\n" . $memory . "</pre>";
    }

    ////////////////////////////
    static function getFileExt($filename) {
        $path_info = pathinfo($filename);
        return $path_info['extension'];
    }

    static function implode_array($array) {
        return '(`' . implode('`,`', array_keys($array)) . "`) VALUES(:" . implode(', :', array_keys($array)) . ")";
    }

    static function implode_arraySet($array) {
        $res = [];
        $keys = array_keys($array);
        foreach ($keys as $k) {
            $res[] = '`' . $k . '`=:' . $k;
        }
        return implode(', ', $res);
    }

    // экранирует строку для сфинкса
    // реализация из Sphinx API
    public static function EscapeSphinx($string) {
        $from = array('\\', '(', ')', '|', '-', '!', '@', '~', '"', '&', '/', '^', '$', '=');
        $to = array('\\\\', '\(', '\)', '\|', '\-', '\!', '\@', '\~', '\"', '\&', '\/', '\^', '\$', '\=');

        return str_replace($from, $to, $string);
    }

    /**
     * Проверка доступа у пользователя
     * @return boolean
     */
    /*
      public static function kma() {
      return \Core\Compatibility::Access('email', 'karpenyam@mail.ru');
      }
      public static function andy() {
      return \Core\Compatibility::Access('email', '650517@355000.ru');
      }
     */
}
