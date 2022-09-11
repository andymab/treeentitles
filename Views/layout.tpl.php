<?php

?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <?= isset($styles) ? $styles : ''; ?>
    <?= isset($css) ? $css : ''; ?>
</head>

<body>
    <?php require(__DIR__ . "/includes/navbar.tpl.php") ?>
    <div class="container">
        <nav>
            <ol class="breadcrumb" id="breadcrumb" style="padding:.5rem;">
                <?php if (isset($action)) : ?>
                    <li class="breadcrumb-item "> <a class="breadcrumb-link" href="<?= IS_HOST ?>"> Home </a></li>
                    <li class="breadcrumb-item " aria-current="/"> <strong> <?= $title ?> </strong> </li>
                <?php else : ?>
                    <li class="breadcrumb-item active" aria-current="/"><strong> Home</strong></li>
                <?php endif; ?>
            </ol>
        </nav>
       <?= $content; ?>
     
    </div>

    <?= isset($scripts) ? $scripts : ''; ?>
    <?= isset($js) ? $js : ''; ?>
</body>

</html>