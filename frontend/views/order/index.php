<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Order Processing';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="order-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($customer, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($customer, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($customer, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($customer, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Process Order', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

