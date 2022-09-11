<?php
$title = "Авторизация";
$layout = "layout";


$js = [];
$jss = '';

 $path = str_replace(rPATH, '', __DIR__);
 $css = [
     $path . '/assets/css/styles.css?h=' . filemtime(__DIR__ . '/' . 'assets/css/styles.css')
 ];


function start_section()
{
    ob_start();
}

function end_section()
{
    return ob_get_clean();
}

//$js = [
//    '/assets/js/jquery.tmpl.min.js',
//    ];

?>

<div class="modal show" >
    <form action="<?= $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : "/"; ?>" method="POST">
        <h6>Авторизация</h6>
        <label for="userEmail">email: <input type="email" name="userEmail" id="userEmail" required></label>
        <label for="formname">password: <input type="password" name="userPassword" id="userPassword" required></label>
        <input type="submit" value="Войти">
    </form>
</div>