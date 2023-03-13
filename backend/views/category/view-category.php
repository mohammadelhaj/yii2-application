<?php

use yii\helpers\Html;
use app\models\Category;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;

?>
<?php foreach ($model as $product) : ?>
    <div class="col-md-4">
        <div class="card w-75">
            <img class="card-img-top" src="/images/plus.png" alt="Product Image">
            <div class="card-body">
                <div class="card-title">
                    <?= $product['productName'] ?>
                </div>
                <div class="card-text">
                    price :$<?= $product['price'] ?>
                </div>
                <div class="card-text">
                    added by: <?= $product['created_by'] ?>
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
                    <?= Html::a('Delete', ['product/updateproduct', 'idProduct' => $product['idProd']], [
                        'class' => 'btn btn-danger',

                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>