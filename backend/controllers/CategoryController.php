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

/**
 * Site controller
 */
class CategoryController extends Controller
{
    // public function behaviors()
    // {

    //     return [

    //         'access' => [
    //             'class' => AccessControl::class,
    //             'only' => ['category', 'addcategory','view','update'],
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['update'],
    //                     'roles' => ['@'],

    //                 ],
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['creatarticlepage', 'postcomment'],
    //                     'roles' => ['@']
    //                 ],
    //             ],
    //         ],
    //     ];
    // }

    public function actionIndex()
    {
        $model = new Category();
        return $this->render('category');
    }
    public function actionCategory()
    {
        $category = Category::find()->all();

        return $this->render('category', [
            'model' => $category,
        ]);
    }

    public function actionAddcategory()
    {
        $category = new Category();
        if ($category->load(Yii::$app->request->post()) && $category->save()) {
            yii::$app->getSession()->setFlash('success', 'category has been added');
            return $this->redirect(['category']);
        } else {
            return $this->render('add-category', [
                'model' => $category,

            ]);
        }
    }
    public function actionView($category_id)
    {
        $product = Product::find()->where(['category' => $category_id])->all();
        return $this->render('view-category', [
            'model' => $product,

        ]);
    }
    public function actionUpdate($category_id)
    {

        $category = Category::find()->where(['idCat' => $category_id])->one();
        if ($category->load(Yii::$app->request->post()) && $category->save()) {
            yii::$app->getSession()->setFlash('success', 'Category has been updated');
            return $this->redirect(['category']);
        }
        return $this->render('add-category', ['model' => $category]);
    }
    public function actionRemoveCategory($category_id)
    {
        $query = Yii::$app->db->createCommand();
        $query->delete('category', ['idCat' => $category_id])->execute();
        yii::$app->getSession()->setFlash('error', 'Category has been deleted');
        return $this->redirect(['category']);
    }
}
