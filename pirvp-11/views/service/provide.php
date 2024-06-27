<?php

/** @var yii\web\View $this */

use app\models\Service;
use app\models\User;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Список оказанных услуг:</h1>
        <?php
            if(!$user_services){
                echo '<p style="margin-top: 20px; margin-bottom: 20px">На данный момент сервис ещё не оказывал услуг</p>';
                if(!Yii::$app->user->isGuest)
                {
                    if(Yii::$app->user->identity->role === 1)
                    {
                        echo '<p style="margin-top: 20px; margin-bottom: 20px">Прибыль с оказанных услуг: 0</p>';
                    }
                }
            }
            else{
                $total_price = 0;
                foreach ($user_services as $user_service):
                    $service = Service::findOne($user_service->service_id);
                    $total_price += $service->price;
                endforeach;
                if(!Yii::$app->user->isGuest)
                {
                    if(Yii::$app->user->identity->role === 1)
                    {
                       echo '<p style="margin-top: 20px; margin-bottom: 20px">Прибыль с оказанных услуг: '.$total_price.'</p>';
                    }
                }
            }
            ?>
    </div>

    <div class="body-content">

        <div class="row" style="width: 300px">
            <?php
                foreach ($user_services as $user_service):
                    $user = User::findOne($user_service->user_id);
                    $service = Service::findOne($user_service->service_id);
                    ?>
                    <p>Название услуги: <?=$service->title?></p>
                    <p>Описание услуги: <?=$service->desc?></p>
                    <p>Цена услуги: <?=$service->price?></p>
                    <p>Логин заказчика: <?=$user->username?></p>
                    <p style="margin-bottom: 50px">Эл. почта заказчика: <?=$user->email?></p>
                <?php endforeach;?>
        </div>

    </div>
</div>
