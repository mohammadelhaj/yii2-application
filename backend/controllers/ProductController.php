<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\Admin;
use common\models\Category;
use common\models\Product;
use yii\debug\models\search\Profile;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class ProductController extends Controller
{
    // public function behaviors()
    // {

    //     return [

    //         'access' => [
    //             'class' => AccessControl::class,
    //             'only' => ['addproduct', 'updateproduct','viewproduct'],
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['update'],
    //                     'roles' => ['@'],

    //                 ],

    //             ],
    //         ],
    //     ];
    // }
    public function actionAddproduct()
    {
        $products = new Product();
        $category = Category::find()->all();

        if ($products->load(Yii::$app->request->post())) {
            $products->img1 = UploadedFile::getInstance($products, 'img1');

            $products->upload($products->img1);
            if ($products->save(false)) {

                return $this->redirect(['product']);
            }
        }

        return $this->render('add-product', [
            'model' => $products,
            'model2' => $category,

        ]);
    }
    public function actionProduct()
    {
        $products = Product::find()->all();

        return $this->render('product', [
            'model' => $products,
        ]);
    }
    public function actionUpdateproduct($idProduct)
    {
        $products = Product::find()->where(['idProd' => $idProduct])->one();
        $category = Category::find()->all();

        if ($products->load(Yii::$app->request->post())) {
            $products->img1 = UploadedFile::getInstance($products, 'img1');

            if ($products->upload($products->img1)) {
                if ($products->save(false)) {

                    return $this->redirect(['product']);
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Failed to upload image');
            }
        }
        return $this->render('add-product', [
            'model' => $products,
            'model2' => $category,

        ]);
    }
    public function actionViewproduct($idProduct)
    {
        $product = Product::find()
            ->where(['idProd' => $idProduct])
            ->one();

        return $this->render('product-view', [
            'model' => $product,


        ]);
    }
    public function actionRemoveProduct($product_id)
    {
        $query = Yii::$app->db->createCommand();
        $query->delete('product', ['idProd' => $product_id])->execute();
        return $this->redirect(['product']);
    }
}
