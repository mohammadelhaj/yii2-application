<?php

use yii\helpers\Html;
use yii\helpers\Url;

Yii::setAlias('@static', 'C:/xampp/htdocs/yii-application/static');
?>
<div class="col-md-12 border border-secondary text-center bg-danger text-white">
    <?= Html::a('Add a product', ['product/addproduct'], [
        'style' => 'text-decoration: none;color: white;'
    ])
    ?>
</div>
<?php foreach ($model as $product) : ?>
    <div class="col-md-4">
        <div class="card w-75">
            <img class="card-img-top" src="<?=$product['image_url']?>" alt="Product Image" width="250px" height="250px">
           <p><?=$product['image_url']?></p>
            <div class="card-body">
                <div class="card-title">
                    <?= $product['productName']; ?>
                </div>
                <div class="card-text">
                    Price: $<?= $product['price']; ?>
                </div>
                <div class="card-text">
                    Category: <?= $product['category']; ?>
                </div>
                <div class="card-text">
                    <?= Html::a('view', ['product/viewproduct', 'idProduct' => $product['idProd']], [
                        'class' => 'btn btn-primary',
                    ]);
                    ?>
                    <?= Html::a('Edit', ['product/updateproduct', 'idProduct' => $product['idProd']], [
                        'class' => 'btn btn-primary w-40',

                    ]);
                    ?>
                    <?= Html::a('Delete', ['product/remove-product', 'product_id' => $product['idProd']], [
                        'class' => 'btn btn-danger',

                    ]);
                    ?>
                </div>
            </div>
        </div>


    </div>
<?php
endforeach;
?>