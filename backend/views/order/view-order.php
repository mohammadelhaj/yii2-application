<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="container h-100 3">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-10">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-normal mb-0 text-black">order Detail for: <u><?= $first_name ?> <?= $last_name ?></u></h3>

            </div>
            <?php
            foreach ($model as $item) :

            ?>
                <div class="card rounded-3 mb-4">
                    <div class="card-body p-4">

                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="http://static.test/<?= $item['img1'] ?>" class="img-fluid rounded-3" alt="product">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="lead fw-normal mb-2"><?= $item['productName']; ?></p>
                                <p><span class="text-muted">Category: </span> <?= $item['category']; ?>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                <h5 class="mb-0">x<?= $item['quantity']; ?></h5>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                <h5 class="mb-0">$<?= $item['item_price']; ?></h5>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">

                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;

            ?>
            <div class="card">
                <div class="card-body">
                    <?= Html::a('Confirme order', ['order/confirm-order', 'order_id' => $order_id], [
                        'class' => 'btn btn-primary btn-block btn-lg',
                    ]) ?>
                    <?= Html::a('Decline order', ['order/decline-order', 'order_id' => $order_id], [
                        'class' => 'btn btn-danger btn-block btn-lg',
                        'style' => 'float: right;',
                    ]) ?>
                </div>


            </div>
          


        </div>
    </div>
</div>