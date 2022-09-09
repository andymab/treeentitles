<?php

class Access {

    public static $user_data = [
        'login' => 'no login',
        'id' => NULL,
        'roles' => ['Not_Autorized'],
    ];

    public function __construct() {
        self::$user_data = [
            'login' => 'no login',
            'id' => NULL,
            'roles' => ['Not_Autorized'],
        ];
    }

    /**
     * Проверка доступа к методу
     * @param string method
     * @param array
     * @return boolean true false
     */
    public static function access($method, $controller_access, $id = '') {
        if (array_key_exists($method, $controller_access)) {
            $array = $controller_access[$method];
        } elseif (array_key_exists('key', $controller_access)) {
            $hash = mb_substr(MD5($id), 0, 5);
            $key = filter_input(INPUT_GET, 'key');
            if ($key === $hash) {
                return true;
            } else $array=[];
//            echo $id."-<br>";
        } elseif (array_key_exists('*', $controller_access)) {
            $array = $controller_access['*'];
        } else {
            return true;
        }


        if (in_array('Admin', self::$user_data['roles'])) {
            return true;
        }

        foreach (self::$user_data['roles'] as $role) {
            if (in_array($role, $array)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Регистрация или продолжение сессии
     * получение и установка пользовательских
     * данных user_data
     * @param string пароль
     * @param string email
     * @return boolean прошла или нет
     */
    public static function set_user($psw = null, $email = null) {
        $db = Connect::_self()->mysql();
        if ($psw and $email) {
            $sth = $db->prepare("SELECT * FROM users__ WHERE email = :email AND psswd=:psswd LIMIT 1");
            $sth->bindParam(':email', ...[$email, \PDO::PARAM_STR]);
            $sth->bindParam(':psswd', ...[md5(md5($psw) . IS_CONFIG_SALT), \PDO::PARAM_STR]);
            $sth->execute();
        
            if (!$sth->RowCount()) {
                return false;
            }
            $res = $sth->fetch(\PDO::FETCH_ASSOC);
            $uid = $res['id'];
            $res['roles'] = json_decode($res['roles'], 1);

            foreach (self::$user_data as $k => $v) {
                self::$user_data[$k] = isset($res[$k]) ? $res[$k] : '';
            }

            $sth = $db->prepare("UPDATE users__ SET sid=:sid WHERE id=:id");
            $sth->bindParam(':sid', ...[Session::get_session_id(), \PDO::PARAM_STR]);
            $sth->bindParam(':id', ...[$uid, \PDO::PARAM_INT]);
            $sth->execute();
        } else {
            $sth = $db->prepare("SELECT * FROM users__ as u WHERE sid=:sid LIMIT 1");
            $sth->bindParam(':sid', ...[Session::get_session_id(), \PDO::PARAM_STR]);
            $sth->execute();
            if (!$sth->RowCount()) {
                return false;
            }

            $res = $sth->fetch(\PDO::FETCH_ASSOC);
            $res['roles'] = json_decode($res['roles'], 1);
            foreach (self::$user_data as $k => $v) {
                self::$user_data[$k] = isset($res[$k]) ? $res[$k] : '';
            }
        }
    }

    public static function set_key($act, $key) {
        return MD5($act . $key);
    }

    public static function ishe($role) {
        return in_array($role, self::$user_data['roles']);
    }

    /**
     *  @return bool
     */
    public static function isAdmin() {
        return in_array('Admin', self::$user_data['roles']);
    }

}
