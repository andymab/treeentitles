<?php
$title = "User dashboard";
$layout = "layout";
$action = "/userDashboard";

$js = [];
$jss = '';

$path = str_replace(rPATH, '', __DIR__);
$css = [
    ( IS_HOST . '/assets/css/user.css?h=' . filemtime(rPATH . '/assets/css/user.css')),
    (IS_HOST . '/assets/css/userstyles.css?h=' . filemtime(rPATH . '/assets/css/userstyles.css')),
];


function start_section()
{
    ob_start();
}

function end_section()
{
    return ob_get_clean();
}


$js = [
    IS_HOST . '/assets/js/user.js?h=' . filemtime( rPATH . '/assets/js/user.js')
];



?>





<h1>User Dashboard</h1>
<?php build_tree($model['data'], 0);
function build_tree($rows, $parent_id)
{
    if (is_array($rows) && isset($rows[$parent_id])) {
        if ($parent_id === 0) : ?>
            <ul id="rootUl" style=" list-style: none;">
            <?php else : ?>
                <ul class="child" style=" list-style: none;">
                <?php endif ?>
                <?php foreach ($rows[$parent_id] as $row) : ?>
                    <li class="element-item">
                        <div class="item-block">
                            <span class="item-title"><?= $row->name ?></span>
                            <div class="item-description">
                                <small>Описание к разделу:</small>
                                <hr>
                                <span>&nbsp;&nbsp;<?= $row->description ?></span>
                            </div>
                            <?php if (array_key_exists($row->id, $rows)) :   ?>
                                <div class="leftactionitem">
                                    <a href="#" class="group up"><span class="item-down">▼</span></a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="childs">
                            <?php build_tree($rows, $row->id); ?>
                        </div>
                    </li>
                <?php endforeach ?>
                </ul>
        <?php } else {
        return false;
    }
}
        ?>