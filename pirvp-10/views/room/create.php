<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\CreateroomForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Создание номера';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните следующие поля для создания номера:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'create-form',
                'options' => ['enctype' => 'multipart/form-data']
            ]); ?>

            <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'desc')->textarea(['rows' => '6']) ?>

            <?= $form->field($model, 'seats')->input('number')->textInput(['placeholder' => 'От 1 до 10 мест']) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
