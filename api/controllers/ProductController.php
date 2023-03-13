<?php

namespace api\controllers;

use yii\rest\Controller;
use common\models\Product;
use yii\filters\auth\HttpHeaderAuth;
use yii\helpers\Json;

/**
 * Product controller
 */
class ProductController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpHeaderAuth::class,
        ];
        return $behaviors;
    }
    public function actionProduct()
    {
        $products = Product::find()->all();
        // $products = Json::encode($products);
        return $products;
    }
}
