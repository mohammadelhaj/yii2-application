<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-10">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>

            </div>
            <?php if ($model == NULL) {
                echo "<h1>you cart is empty!</h1>";
            } else {
                foreach ($model as $product) :

            ?>
                    <div class="card-element card rounded-3 mb-4" data-id = "#<?= "product-id-".$product['idProd'] ?>">
                        <div class="card-body p-4">

                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img src="http://static.test/<?= $product['img1'] ?>" class="img-fluid rounded-3" alt="product">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <p class="lead fw-normal mb-2"><?= $product['productName']; ?></p>
                                    <p><span class="text-muted">Category: </span> <?= $product['category']; ?>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    
                                    <button type="button" class="decrease-qty btn btn-link px-2"
                                        data-price="#<?= "price-".$product['idProd'] ?>"
                                        data-input="#<?= "product-qty-".$product['idProd'] ?>"
                                        data-href="<?= Url::to( ['remove-quantity', 'product_id' => $product['idProd']]) ?>">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    
                                    <?= Html::input('number', "quantity[".$product['idProd']."]",  $product['quantity'], [
                                        'class' => 'form-control form-control-sm',
                                        'id'=>"product-qty-".$product['idProd']
                                    ]) ?>
                                    
                                        <button  type="button" class="increase-qty btn btn-link px-2"
                                        data-price="#<?= "price-".$product['idProd'] ?>"
                                        data-input="#<?= "product-qty-".$product['idProd'] ?>"
                                        data-href="<?= Url::to( ['add-quantity', 'product_id' => $product['idProd']]) ?>">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h5 class="mb-0">$<span id="price-<?= $product['idProd'] ?>"><?= $product['price']; ?><span></h5>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <?= Html::a('<i class="fa fa-trash fa-lg"></i>', ['remove-from-cart', 'product_id' => $product['idProd']], [
                                        'class' => 'remove-from-shoping_cart btn btn-danger',
                                        
                                        
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            }
            ?> <?php if ($model != NULL) { ?>
                <div class="money-container card">
                    <div class="money-counter card-body">
                        <?= Html::a('Go to check out', ['place-order/check-out', 'user_id' => Yii::$app->user->id], [
                            'class' => 'btn btn-primary btn-block btn-lg',
                        ]) ?>   
                        <div style="float: right;">
                             <h3>your total: $<span id="total_price" data-total="#<?= "total-".$product['idProd']?>"><?=$total_price?></span> </h3>
                        </div>
                       
                    </div>
                    

                </div>
            <?php } ?>

        </div>
    </div>
</div>