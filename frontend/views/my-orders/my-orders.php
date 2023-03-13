<?php

use yii\helpers\Html;
?>
<div class="row" style="padding-top: 30px;">

    <?php
    foreach ($model as $my_orders) :
        if ($my_orders->order_status == "pending") {
            $theme = "bg-orange";
        } else if ($my_orders->order_status == "confirmed") {
            $theme = "bg-green";
        } else {
            $theme = "bg-red";
        }
    ?>
        <div class="card rounded-3 mb-4 <?= $theme ?>">
            <div class="card-body p-4">

                <div class="row d-flex justify-content-between align-items-center">

                    <div class="col-md-3 col-lg-3 col-xl-3">
                        <p class="lead fw-normal mb-2"><?= $my_orders->first_name; ?></p>
                        <p><span class="text-muted">your order id: </span> <?= $my_orders->id ?>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h5 class="mb-0">total cost: $<?= $my_orders->total_cost ?></h5>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end" style="white-space: nowrap;">
                        <?= $my_orders->order_status ?>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <?= Html::a('See details', ['order-detail', 'order_id' => $my_orders->id], [
                            'class' => 'btn btn-primary',

                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>



</div>