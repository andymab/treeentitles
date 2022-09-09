<?php

//namespace mclass;

class Connect {

    private $db;
    public static $_self = null;
    private $connections = [];

    public static function _self() {
        if (self::$_self == null) {
            self::$_self = new self();
        }
        return self::$_self;
    }

    /*
     * Метод для работы с СУБД MySQL
     */

    public function mysql($user = DB_USER, $pass = DB_PSWD, $dbname = DB_NAME, $host = DB_HOST) {
        $dsn = "mysql:dbname={$dbname};host={$host}";

        $hash = md5($dsn . $user . $pass . $host);

        if (!array_key_exists($hash, $this->connections)) {
            $db = new \PDO($dsn, $user, $pass, [
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8", //кодировка
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, //По умолчанию работать с данными в виде объекта
                \PDO::ATTR_ERRMODE => true,
                \PDO::ERRMODE_EXCEPTION => true,
            ]);
            $this->connections[$hash] = $db;
        }

        return $this->connections[$hash];
    }

    public function sqlite($base_path, $user = '', $pass = '', $host = '127.0.0.1') {
        $dsn = "sqlite:{$base_path}";

        $hash = md5($dsn . $user . $pass . $host);

        if (!array_key_exists($hash, $this->connections)) {
            $db = new \PDO($dsn, $user, $pass, [
                \PDO::ATTR_ERRMODE => true,
                \PDO::ERRMODE_EXCEPTION => true,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_TIMEOUT => 5000,
            ]);
            $this->connections[$hash] = $db;
        }

        return $this->connections[$hash];

        //print_r($this->dbsqlite);
        //return $this->dbsqlite;
        //$db->exec('PRAGMA journal_mode=WAL;');//многопоточный режим
    }

    public static function get_columns($table) {
        $db = self::_self()->mysql();
        $sth = $db->prepare("SHOW COLUMNS FROM `{$table}`");
        $sth->execute();
        return array_map(function($item) {
            return $item->Field;
        }, $sth->fetchAll());
    }

    public static function get_maps($table) {
        $db = self::_self()->mysql();
        $sth = $db->prepare("SHOW COLUMNS FROM `{$table}`");
        $sth->execute();
        $ms = [];
        foreach ($sth->fetchAll() as $key => $item) {
            $ms[$item->Field] = strpos($item->Type, 'int') === false ? \PDO::PARAM_STR : \PDO::PARAM_INT;
        }
        return $ms;
    }

    /**
     *
     * @param string $table имя таблицы
     * @param array $select DEFAULT NULL столбцы
     * @param string $order DEFAULT NULL сортировка
     * @return object fetchall()
     */
    public static function get_content($table, $select = ["*"], $order = '') {
        $select = implode(', ', $select);
        if ($order) {
            $order = " ORDER BY " . $order;
        }

        $db = self::_self()->mysql();
        $sth = $db->prepare("SELECT {$select} FROM {$table} {$order}");
//        print_r($sth);exit;
        $sth->execute();
        return $sth->fetchall();
    }

    /**
     *
     * @param string $table наименование таблицы
     * @param array $row массив строки для добавдения
     * @return array('status','message',data['id'=>lastinsertID])
     */
    public static function add_row($table, $row) {
        if (!sizeof($row))
            return false;

        $map = self::get_maps($table);
        unset($map['id']);
        $db = self::_self()->mysql();


        try {
            $sth = $db->prepare("INSERT LOW_PRIORITY IGNORE INTO " . htmlspecialchars($table) . (\Sfn::implode_array($map)));
//            print_r($sth);die;
            foreach ($map as $key => $val) {
                $sth->bindParam(":$key", ...[isset($row[$key]) ? $row[$key] : '', $val]);
            }
            $sth->execute();
            if ($sth->RowCount() == 1) {
                return \Sfn::message(true, 'запись добавлена', ['id' => $db->LastinsertId()]);
            } else {
                return \Sfn::message(false, 'дубликат', []);
            }
        } catch (\PDOException $e) {

            return \Sfn::message(false, $e->getLine() . ' -:- ' . $e->getMessage());
        }
    }

    private static function getkeys($array) {
        return $keys = array_keys($array);
    }
    private static function statusRowcout($sth) {
           if ($sth->RowCount() >= 1) { 
                    return \Sfn::message(true, 'запись изменена');
            } else {
                return \Sfn::message(false, 'запись без изменений');
            }
    }
    
    /**
     *
     * @param string $table наименование таблицы
     * @param array $row массив строка для изменения
     * @param string $where id=:id
     * @return array('status','message')
     */
    public static function update_row($table, $row, $where = 'id=:id') {
        $map = self::get_maps($table);
        unset($map['id']);
        foreach (self::getkeys($map) as $k) {
            if (!isset($row[$k])) {
                unset($map[$k]);
            }
        }
        $db = self::_self()->mysql();
        try {
            $sql = "UPDATE LOW_PRIORITY IGNORE " . $table . ' SET ' . (\Sfn::implode_arraySet($map)) . " WHERE " . $where;
            $sth = $db->prepare($sql);
            if ($where == 'id=:id') {
                $sth->bindParam(":id", $row['id'], \PDO::PARAM_INT);
            }
            foreach ($map as $key => $val) {
                if (isset($row[$key])) { //если поля не переданы обновлять не нужно
                    $sth->bindParam(":$key", $row[$key], $val);
                }
            }
            $sth->execute();
            return self::statusRowcout($sth);
        } catch (\PDOException $e) {
            return \Sfn::message(false, $e->getLine() . ' -:- ' . $e->getMessage());
        }
    }

    /**
     *
     * @param string $table наименование таблицы
     * @param int $id строка для изменения
     * @param array $keys  не обязательна 
     * @param int $key ключ не обязательна
     * @return type array('status','message')
     */
    public static function delete_row($table, $id, $keys = ['id=:id'], $key = 'id') {
        $db = self::_self()->mysql();
        try {

            $sth = $db->prepare("DELETE FROM " . $table . " WHERE " . implode(' AND ', $keys));

            $sth->bindParam(":$key", $id, \PDO::PARAM_INT);
            $sth->execute();
            if ($sth->RowCount() >= 1) {
                return \Sfn::message(true, 'запись удалена');
            } else {
                return \Sfn::message(false, 'отсутствует запись ?!!');
            }
        } catch (\PDOException $e) {
            return \Sfn::message(false, $e->getLine() . ' -:- ' . $e->getMessage());
        }
    }

    /**
     *
     * @param type string имя таблицы
     * @return type array('status','message',[data=>araay])
     */
    public static function get_all($table) {
        try {
            $db = self::_self()->mysql();
            $table = htmlspecialchars($table);
            $sth = $db->prepare("SELECT * FROM `{$table}`");
            $sth->execute();
            if ($sth->RowCount()) {
                return \Sfn::message(true, 'data', $sth->fetchall());
            } else {
                return \Sfn::message(true, 'not data', []);
            }
        } catch (\PDOException $e) {
            return \Sfn::message(false, $e, []);
        }
    }

    /**
     *
     * @param string $table имя таблицы
     * @param array $keys масив ключей для binding
     * @param string $order NULL порядок ключи сортировки
     * @return array \fn::message(status,message,data)
     */
    public static function get_content_keys($table, $keys, $order = '') {
        try {
            $order = $order ? ' ORDER BY ' . $order : '';
            $db = self::_self()->mysql();

            $map = self::get_maps($table);

            $sth = $db->prepare("SELECT * FROM " . htmlspecialchars($table) . " WHERE " . \Sfn::implode_arraySet($keys) . $order);

            foreach ($map as $k => $v) {
                if (isset($keys[$k])) {
                    $sth->bindParam(":$k", $keys[$k], $v);
                }
            }
            $sth->execute();
            if ($sth->RowCount()) {
                return \Sfn::message(true, 'data', $sth->fetchall());
            } else {
                return \Sfn::message(false, 'not data', []);
            }
        } catch (\PDOException $e) {
            return \Sfn::message(false, $e->getMessage(), []);
        }
    }

    /**
     * @param string $table имя таблицы
     * @param array $keys массив id для id IN(key,key,key)
     * @return type array \fn::message(status,message,data)
     */
    public static function get_rows_id_in_keys($table, $keys) {
        try {
            $db = self::_self()->mysql();
            $sth = $db->query("SELECT * FROM " . htmlspecialchars($table) . " WHERE id IN(" . implode(', ', $keys) . ")");
            if ($sth->RowCount()) {
                return \Sfn::message(true, 'data', $sth->fetchall());
            } else {
                return \Sfn::message(false, 'not data', []);
            }
        } catch (\PDOException $e) {
            return \Sfn::message(false, $e->getMessage(), []);
        }
    }

    /**
     *
     * @param string $table наименование таблицы
     * @param int $id id
     * @param array $select
     * @return array \fn::message(status,message,data)
     */
    public static function get_row_byId($table, $id, $select = ['*']) {
        try {
            $db = self::_self()->mysql();

            $sth = $db->prepare("SELECT " . implode(',', $select) . " FROM " . htmlspecialchars($table) . " WHERE id=:id LIMIT 1");

            $sth->bindParam(":id", $id, \PDO::PARAM_INT);
            $sth->execute();
            if ($sth->RowCount()) {
                return \Sfn::message(true, 'data', $sth->fetch());
            } else {
                return \Sfn::message(false, 'not data', []);
            }
        } catch (\PDOException $e) {
            return \Sfn::message(false, $e->getMessage(), []);
        }
    }

    /**
     *
     * @param string $table наименование таблицы
     * @param string $columns наименование колонки
     * @param int $id ID записи
     * @return array колонка->значение
     */
    public static function get_column_byId($table, $columns, $id) {
        try {
            $db = self::_self()->mysql();

            $sth = $db->query("SELECT " . $columns . " FROM " . htmlspecialchars($table) . " WHERE id=" . $id . " LIMIT 1");
            if ($sth->RowCount()) {
                return \Sfn::message(true, 'data', $sth->fetch());
            } else {
                return \Sfn::message(false, 'not data', []);
            }
        } catch (\PDOException $e) {
            return \Sfn::message(false, $e->getMessage(), []);
        }
    }

    public static function query($q) {
        try {
            $db = self::_self()->mysql();
            $sth = $db->query($q);
            if ($sth->RowCount()) {
                return \Sfn::message(TRUE, 'data', $sth->fetchall());
            } else {
                return \Sfn::message(true, 'not data', []);
            }
        } catch (\PDOException $e) {
            return \Sfn::message(false, $e, []);
        }
    }

}
