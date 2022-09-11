<?php
$title = "Home";
$layout = "layout";



$js = [];
$jss = '';

// $path = str_replace(rPATH, '', __DIR__);
// $css = [
//     $path . '/assets/css/styles.css?h=' . filemtime(__DIR__ . '/' . 'assets/css/styles.css')
// ];


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


<?php foreach (file(rPATH . '/README.md') as $line) : ?>
<?php if (empty(trim($line)) ) : ?>
    <?= '' ?>
<?php elseif (mb_strpos($line, '###') !== false) : ?>
    <h3><?= str_replace("###", "", $line); ?> </h3>
<?php elseif (mb_strpos($line, "##") !== false) : ?>
    <h2><?= str_replace("##", "", $line); ?></h2>
<?php elseif (mb_strpos($line, "#") !== false) : ?>
    <h1><?= str_replace("#", "", $line) ?></h1>
<?php else : ?>
    <p><?= $line ?></p>
<?php endif ?>
<?php endforeach ?>
