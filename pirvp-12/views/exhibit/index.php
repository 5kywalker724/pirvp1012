<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Список экспонатов:</h1>
        <?php
        if(!$exhibits){
            echo '<p style="margin-top: 20px; margin-bottom: 20px">На данный момент нету экспонатов</p>';
        }
        ?>
    </div>

    <div class="body-content">

        <div class="row" style="width: 450px">
           <?php
                foreach($exhibits as $exhibit):
                ?>
                    <h3>Название экспоната: <?=$exhibit->title?></h3>
                    <p>Описание экспоната: <?=$exhibit->desc?></p>
                    <p style="margin-bottom: 30px">Количество: <?=$exhibit->quantity?></p>
                <?php
           endforeach;?>
        </div>

    </div>
</div>
