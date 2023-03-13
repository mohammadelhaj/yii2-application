<?php

use yii\helpers\Html;
?>
<h1>all Products</h1>
<div class="row">
    <?php foreach ($model as $product) : ?>

        <div class="col-md-3">
            <div class="card w-75">


                <img class="card-img-top" src="<?= $product['image_url'] ?>" alt="Product Image" width="250px" height="250px" alt="Product Image">
                <p><?= $product['image_url'] ?></p>
                <div class="card-body">
                    <div class="card-title">
                        <?= $product['productName']; ?>
                    </div>
                    <div class="card-text">
                        price: $<?= $product['price_lbp']; ?>
                    </div>
                    <div class="card-text">
                        Category: <?= $product['category']; ?>
                    </div>
                    <div class="card-text">
                        <?= Html::a('Add to cart', ['shopping-cart/add-to-shopping-cart', 'product_id' => $product['idProd'], 'user_id' => Yii::$app->user->id], [
                            'class' => 'btn btn-primary',
                        ]);
                        ?>
                        <?= Html::a('Buy', ['product/updateproduct', 'idProduct' => $product['idProd']], [
                            'class' => 'btn btn-primary w-40',

                        ]);
                        ?>

                    </div>
                </div>
            </div>


        </div>

    <?php
    endforeach;
    ?>
</div>