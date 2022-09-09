<?php
require __DIR__ . "/.conf.php";
$db = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$query = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "strorage" . DIRECTORY_SEPARATOR . "setup" . DIRECTORY_SEPARATOR . "setup.sql");
if (mysqli_multi_query($db, $query))
    echo "Success";
else
    echo "Fail";

// заполнить администратора
$psw = md5(md5('admin') . IS_CONFIG_SALT);
$query = 'INSERT INTO `users__` (`id`, `sid`, `login`, `email`, `psswd`, `restime`, `regtime`, `descr`, `roles`) VALUES' .
    '(1, "", "admin", "admin@admin.ru", "' . $psw . '", ' . time() . ', ' . time() . ', "администратор", "[\"Admin\"]")';
if (mysqli_query($db, $query)) {
    echo "Success";
} else {
    echo "Fail user not create";
}
