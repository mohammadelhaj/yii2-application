<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\Product;


/**
 * Product controller
 */
class ProductController extends Controller
{

    public function actionProduct()
    {
        $products = Product::find()->all();

        return $this->render('all-products', [
            'model' => $products,
        ]);
    }

}
