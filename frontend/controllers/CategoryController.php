<?php

namespace frontend\controllers;

use common\models\ShoppingCart;
use common\models\Product;
use common\models\Order;
use common\models\Category;
use Yii;
use yii\web\Controller;


class CategoryController extends Controller
{
    public function actionCategory($category_id)
    {
        $category = Product::find()
            ->join('INNER JOIN', 'category', 'product.category = category.idCat')
            ->where(['category.idCat' => $category_id])
            ->all();
        return $this->render('category', [
            'model' => $category,
            'category_id' => $category_id,
        ]);
    }
}
