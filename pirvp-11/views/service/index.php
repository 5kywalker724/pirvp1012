<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Список оказываемых услуг:</h1>
        <?php
            if(!$services){
                echo '<p style="margin-top: 20px; margin-bottom: 20px">На данный момент сервис не оказывает услуг</p>';
            }
        ?>
    </div>

    <div class="body-content">

        <div class="row" style="width: 300px">
            <?php
                foreach ($services as $service):
                    ?>
                    <p>Название услуги: <?=$service->title?></p>
                    <p>Описание услуги: <?=$service->desc?></p>
                    <p>Цена услуги: <?=$service->price?></p>
                <?php
                    if(!Yii::$app->user->isGuest)
                    {
                        echo Html::a('Заказать услугу', ['/service/order', 'id' => $service->id],
                        ['class' => 'btn btn-primary']);
                    }
                endforeach;?>
        </div>

    </div>
</div>
