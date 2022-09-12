<?php
require __DIR__ . "/.conf.php";
header("Location: /");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "strorage" . DIRECTORY_SEPARATOR . "setup" . DIRECTORY_SEPARATOR . "setup.sql");

try{
    mysqli_multi_query($db, $query);
} catch(\Exception $e){
  \Sfn::pre($e);
  exit;
}
$db->close();
    echo "Success<br>";


$row = [
    'sid'=>1,
    'login'=>'user', 
    'email'=>'user@user.ru', 
    'psswd'=> md5(md5('user') . IS_CONFIG_SALT), 
    'restime'=>time(), 
    'regtime'=>time(), 
    'descr'=>"пользователь", 
    'roles'=>json_encode(["User"])
];
$q = \Connect::add_row('users__', $row);
if (\Sfn::status($q)) {
    echo "Пользователь с правами User добавлен<br>";
} else {
    \Sfn::pre($q);
    exit;
}

$row = [
    'sid'=>2,
    'login'=>'admin', 
    'email'=>'admin@admin.ru', 
    'psswd'=> md5(md5('admin') . IS_CONFIG_SALT), 
    'restime'=>time(), 
    'regtime'=>time(), 
    'descr'=>"администратор", 
    'roles'=>json_encode(["Admin","User"])
];


$q = \Connect::add_row('users__', $row);
if (\Sfn::status($q)) {
    echo "Пользователь с правами Admin добавлен";
} else {
     \Sfn::pre($q);
     exit;
}

