<?php

/** @var yii\web\View $this */

use app\models\RoomBooking;
use app\models\User;
use yii\bootstrap5\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Список номеров:</h1>

        <?php if(!$rooms){
            echo '<p class="lead">На данный момент нету номеров</p>';
        }
        ?>
    </div>

    <div class="body-content">

        <div class="row" style="width: 300px">
            <?php
                 if(!Yii::$app->user->isGuest)
                {
                    $user = User::findOne(Yii::$app->user->identity->id);
                    foreach($rooms as $room):
                        ?>
                        <div style="margin-bottom: 50px">
                            <h3><?=$room->title?></h3>
                            <p><?= $room->desc ?></p>
                            <p>Количество доступных мест в номере: <?= $room->seats ?></p>
                            <?php
                            $room_booking = RoomBooking::find()->where(['user_id' => $user->id, 'room_id' => $room->id])->one();
                            //                        $room_booking = RoomBooking::find()->where(['user_id' => $user->id])->one();
                            if($room->seats > 0 && $room_booking === null)
                            {
                                echo Html::a('Забронировать номер', ['/room/book',
                                    'id' => $room->id], ['class' => 'btn btn-primary']);
                            }
                            ?>
                        </div>
                    <?php endforeach;
                }
                else
                {
                    foreach($rooms as $room):
                        ?>
                        <div style="margin-bottom: 50px">
                            <h3><?=$room->title?></h3>
                            <p><?= $room->desc ?></p>
                            <p>Количество доступных мест в номере: <?= $room->seats ?></p>
                        </div>
                    <?php endforeach;
                }
            ?>
        </div>

    </div>
</div>
