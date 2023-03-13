<?php

use common\models\Category;
use yii\helpers\Html;
$category = Category::findOne(3);

?>
<h1>
</h1>
<div class="row" style="padding-top: 30px;">

    <?php
    foreach ($model as $product) :

    ?>
        <div class="col-md-3">
            <div class="card m-3" style="border: 0px;text-align: center;">
                <img class="border" src="<?= $product->image_url ?>" class="card-img-top" alt="Product Name" width="250" height="250">
                <div class="card-body">
                    <h5 class="card-title"><?= $product->product_name ?></h5>
                    <h5 class="card-title"><?= $product->details ?></h5>
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <p class="card-text">lbp <?= $product->price_lbp ?></p>
                    <?= Html::a(
                        'Add to cart',
                        [
                            'shopping-cart/add-to-shopping-cart', 'product_id' => $product['idProd'],
                            'user_id' => Yii::$app->user->id,
                            'category_id' => $category_id,
                        ],
                        [
                            'class' => 'add-to-cart btn btn-primary',
                            'id' => 'btn_' . $product['idProd'],
                            'style' => 'border-radius: 0;background-color: black;',
                        ]
                    ); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>



</div>