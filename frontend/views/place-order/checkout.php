<?php

use Codeception\Lib\Generator\Actor;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>
<div class="container">
    <div class="py-5 text-center">
    </div>

    <div class="row g-5">

        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
                <span class="badge bg-primary rounded-pill"><?= $number_of_items ?></span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$<?= $total_price ?></strong>
                </li>
                <?php
                foreach ($model as $product) :
                ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0"><?= $product['productName'] ?> x(<?= $product['quantity'] ?>)</h6>
                            <small class="text-muted"><?= $product['description'] ?></small>
                        </div>
                        <span class="text-muted">$<?= $product['price'] ?></span>
                    </li>
                <?php
                endforeach;
                ?>

            </ul>

        </div>
        <div class="col-md-7 col-lg-8">
            <?php $form = ActiveForm::begin([
                'action' => ['place-order', 'user_id' => Yii::$app->user->id]
            ]); ?>

            <h4 class="mb-3">Billing address :</h4>
            <hr class="my-4">
            <div class="row g-3">

                <div class="col-sm-6">

                    <?= $form->field($order, 'first_name')->textInput(['class' => 'form-control'])->label('first name'); ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($order, 'last_name')->textInput(['class' => 'form-control'])->label('last name'); ?>

                </div>

                <div class="col-12">
                    <?= $form->field($order, 'address')->textInput(['placeholder' => 'Your address', 'class' => 'form-control'])->label('Address'); ?>

                    <?= $form->field($order, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false); ?>

                    <?= $form->field($order, 'total_cost')->hiddenInput(['value' => $total_price])->label(false); ?>
                    <?= $form->field($order, 'order_status')->hiddenInput(['value' => 'pending'])->label(false); ?>
                    <?= $form->field($order, 'date')->hiddenInput(['value' => date("Y-m-d")])->label(false); ?>
                </div>

            </div>
            <hr class="my-4">

            <?= Html::submitButton('Place your order', ['class' => 'w-100 btn btn-primary btn-lg']) ?>


            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>