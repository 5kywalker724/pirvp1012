<?php

/** @var yii\web\View $this */

use app\models\RoomBooking;
use app\models\User;
use yii\bootstrap5\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Список проживающих гостиницы:</h1>

        <?php if(!$users){
            echo '<p class="lead">На данный момент нету проживающих</p>';
        }
        ?>
    </div>

    <div class="body-content">

        <div class="row" style="width: 500px">
            <?php
                foreach($users as $user):
                ?>
                    <div style="margin-bottom: 50px">
                        <p>Имя проживающего: <?=$user->username?></p>
                        <p>Эл. почта проживающего: <?= $user->email ?></p>
                    </div>
                <?php endforeach; ?>
        </div>

    </div>
</div>
