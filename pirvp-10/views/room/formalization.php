<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\CreateformalizeForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Оформление проживающих';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if($message)
    {
        ?>
        <p style="margin-top: 20px; margin-bottom: 20px"><?=$message?></p>
        <?php
    }
    ?>

    <p>Пожалуйста, заполните следующие поля для оформления забронированного номера:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'create-form',
                'options' => ['enctype' => 'multipart/form-data']
            ]); ?>

            <?= $form->field($model, 'user_id')->dropDownList($users, [
                    'prompt' => 'Выберите пользователя'
            ]) ?>

            <?= $form->field($model, 'room_id')->dropDownList($rooms, [
                    'prompt' => 'Выберите номер соответствующий пользователю'
            ]) ?>

            <?= $form->field($model, 'formalization')->textInput(['placeholder' => 'Да']) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Оформить', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
