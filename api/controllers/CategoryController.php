<?php

namespace api\controllers;

use yii\rest\Controller;
use common\models\Category;
use common\models\LoginForm;
use common\models\Product;
use yii\filters\auth\HttpHeaderAuth;
use Yii;
use yii\web\ForbiddenHttpException;

class CategoryController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpHeaderAuth::class,
        ];
        return $behaviors;
    }
    public function actionIndex()
    {
        $categories = Category::find()->all();

        return $categories;
    }
    public function actionCategory($category_id)
    {
        $category = Product::find()
            ->join('INNER JOIN', 'category', 'product.category = category.idCat')
            ->where(['category.idCat' => $category_id])
            ->all();

        return $category;
    }
}
