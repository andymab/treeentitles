<?php
$title = "Admin dashboard";
$action = "/adminDashboard";
$layout = "layout";


$js = [];
$jss = '';

$path = str_replace(rPATH, '', __DIR__);
$css = [
    $path . DIRECTORY_SEPARATOR . 'styles.css?h=' . filemtime(__DIR__ .  DIRECTORY_SEPARATOR . 'styles.css')
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
    $path . DIRECTORY_SEPARATOR . 'index.js?h=' . filemtime(__DIR__ .  DIRECTORY_SEPARATOR . 'index.js')
];


?>

<h1><?= $title ?></h1>
<h6 > Добавить раздел
    <div class="leftactionitem">
        <a href="#" id="newblock" title="Добавить раздел"><span class="item-span">&#10010;</span></a>
    </div>
</h6>
<hr>
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
                    <li class="element-item" data-tree_key="<?= $row->tree_key ?>" data-id="<?= $row->id ?>" data-description="<?= $row->description ?>">
                        <div class="item-block" id="<?= $row->id ?>">
                            <span class="item-title"><?= $row->name ?></span>
                            <?php if (array_key_exists($row->id, $rows)) :   ?>
                                <div class="leftactionitem">
                                    <a href="#" class="group up"><span class="item-down">▼</span></a>
                                </div>

                            <?php endif; ?>
                            <div class="actionitem">
                                <a href="#" class="addItem" title="Добавить в раздел"><span class="item-span">&#10010;</span></a>
                                <a href="#" class="editItem" title="Редактировать раздел"><span class="item-span">&#9999;</span></a>
                                <a href="#" class="removeItem" title="Удалить раздел"><span class="item-span"><strong>X</strong></span></a>
                            </div>
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


        <div id="modalAddItem" class="modalAddItem modal">
            <form action="/adminDashboard/addItem" method="post">
                <h6>Добавить раздел</h6>
                <input type="hidden" name="tree_key">
                <input type="hidden" name="id">
                <label for="formname">Название раздела: <input type="text" name="name" id="formname" required></label>
                <label for="formname">Описание раздела: <textarea name="description" id="formdescription" cols="30" rows="5"></textarea></label>
                <div class="action">
                    <input type="submit" value="Добавить">
                    <button class="reset">Отменить</button>
                </div>
            </form>
        </div>

        <div id="modalAlert" class="modalAlert modal">
            <form>
                <h6>Сообщение</h6>
                <p></p>
                <button class="reset">Закрыть</button>
            </form>
        </div>


        <div id="modalupdateItem" class="modal">
            <form action="/adminDashboard/updateItem" method="post">
                <h6>Изменить раздел</h6>
                <input type="hidden" name="tree_key">
                <input type="hidden" name="id">
                <label for="formname">Название раздела: <input type="text" name="name" id="formname"></label>
                <label for="formname">Описание раздела: <textarea name="description" id="formdescription" cols="30" rows="5"></textarea></label>

                <div class="action">
                    <input type="submit" value="Изменить">
                    <button class="reset">Отменить</button>
                </div>

            </form>
        </div>

        <div id="modalremoveItem" class="modal">
            <form action="/adminDashboard/removeItem" method="post">
                <h6 style="color:red">Вы собираетесь удалить раздел и его потомков !!!</h6>
                <input type="hidden" name="tree_key">
                <input type="hidden" name="id">
                <label for="formname">Название раздела: <input type="text" name="name" id="formname"></label>
                <label for="formname">Описание раздела: <textarea name="description" id="formdescription" cols="30" rows="3"></textarea></label>
                <div class="action">
                    <input type="submit" value="Удалить">
                    <button class="reset">Отменить</button>
                </div>

            </form>
        </div>




        <!-- эту реализацию убрал -->
        <template id="element_list_node">
            <li class="element-item" data-tree_key="" data-id="" data-description="">
                <div class="item-block">
                    <span class="item-title">Раздел</span>
                    <div class="actionitem">
                        <a href="#" class="addItem" title="Добавить раздел"><span class="item-span">&#10010;</span></a>
                        <a href="#" class="editItem" title="Редактировать раздел"><span class="item-span">&#9999;</span></a>
                        <a href="#" class="removeItem" title="Удалить раздел"><span class="item-span"><strong>X</strong></span></a>
                    </div>
                </div>
            </li>
        </template>

        <?php
        $message = null;
        if (array_key_exists('message', $model) && $model['message']) {
            $message = $model['message'];
            $status = $model['status'];
            $anchorid = isset($model['anchorid']) ? $model['anchorid'] : '';
        }
        ?>

        <?php if ($message) : ?>
            <script>
                setTimeout(function() {
                    modalalert("<?= $message ?>", "<?= $status ?>");
                }, 100);

                var anchorid = "<?= $anchorid ?>";
                if (anchorid != 0) {
                    document.getElementById(anchorid).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            </script>
        <?php endif ?>