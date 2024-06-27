<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Список отчетов:</h1>
        <?php
        if(!$inventories){
            echo '<p style="margin-top: 20px; margin-bottom: 20px">На данный момент нету отчетов</p>';
        }
        ?>
    </div>

    <div class="body-content">

        <div class="row" style="width: 450px">
           <?php
                foreach($inventories as $inventory):
                ?>
                    <h3>Название экспоната: <?=$inventory->title?></h3>
                    <p>Количество экспоната: <?=$inventory->quantity?></p>
                    <?php
                        if($inventory->quantity === 0)
                        {
                            echo '<p>Экспонат на данный момент отсутствует в музее</p>';
                        }
                    ?>
                    <p style="margin-bottom: 30px">Дата создания отчета: <?=$inventory->inventory_date?></p>
                <?php
           endforeach;?>
        </div>

    </div>
</div>
