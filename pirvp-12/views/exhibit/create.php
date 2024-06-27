<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Добавление экспонатов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста заполните следующие поля для добавления экспоната:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'create-form',
            ]); ?>

            <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'quantity')->input('number')->textInput(['placeholder' => 'Минимум 1 экземпляр']) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
