<?php

namespace api\controllers;

use Yii;
use yii\rest\Controller;

use common\models\ShoppingCart;
use common\models\Product;
use yii\filters\auth\HttpHeaderAuth;
use yii\helpers\Json;
use yii\web\Response;

class ShoppingCartController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpHeaderAuth::class,
        ];
        return $behaviors;
    }
    public function actionShoppingCart($user_id)

    {

        $user_id = Yii::$app->user->id;
        $a = new ShoppingCart();
        $query = "SELECT *
        FROM product 
        INNER JOIN `shopping-cart`
        ON product.idProd= `shopping-cart`.product_id WHERE `shopping-cart`.quantity !=0 AND `shopping-cart`.user_id=$user_id ";
        
        $products = Product::find()
        ->innerJoin('`shopping-cart`', 'product.idProd = `shopping-cart`.product_id')
        ->where(['`shopping-cart`.user_id' => $user_id])
        ->all();
         
        $total_price = ShoppingCart::find()
            ->select(['SUM(price)'])
            ->where(['user_id' => $user_id,]);

        $price = $total_price->SUM('price');

        $quantity_is_zero = ShoppingCart::deleteAll('quantity = 0');


        $data = Yii::$app->db->createCommand($query)->queryAll();
        // echo "<pre>";
        // print_r($data);
        // echo "__________________________________________________________";
        // print_r($products);
        // echo "</pre>";
        // exit;
        return  [
            'model' => $data,
            'total_price' => $price,
            // 'model2' => $a,
        ];
    }

    public function actionAddToShoppingCart($product_id)
    {
        $user_id = Yii::$app->user->id;

        $model = ShoppingCart::find()->where(['product_id' => $product_id, 'user_id' => $user_id])->one();
        $product = Product::find()->select('price')->where(['idProd' => $product_id])->one();
        if (!empty($model)) {
            $product_price = $product->price;
            $model->quantity =  $model->quantity + 1;
            $model->price = $model->quantity * $product_price;
            $model->save();
            return [
                'model' => $model,
            ];
        } else {
            $shopping_cart = new ShoppingCart();
            $shopping_cart->user_id = $user_id;
            $shopping_cart->product_id = $product_id;
            $shopping_cart->quantity = 1;
            $shopping_cart->price = $product->price;
            $shopping_cart->save();
            return [
                'model' => $model,
            ];
        }
    }
    public function actionAddQuantity($product_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $product = Product::find()->where(['idProd' => $product_id])->one();
        if (!empty($product)) {
            $user_id = Yii::$app->user->id;
            $model = ShoppingCart::find()->where(['product_id' => $product_id, 'user_id' => $user_id])->one();
            $total_price = ShoppingCart::find()
                ->select(['SUM(price)'])
                ->where(['user_id' => $user_id,]);
            $price = $total_price->SUM('price');
            if (!empty($model)) {
                $model->quantity = $model->quantity + 1;
                $model->price = $product->price * $model->quantity;
                $model->save();
                // yii::$app->getSession()->setFlash('success', 'product quantity updated in shopping cart');
                //echo "hello world";
                //return $this->redirect(['shopping-cart/shopping-cart', 'user_id' => $user_id]);


                $price = $total_price->SUM('price');
                return [
                    'success' => true,
                    'message' => "",
                    'qty' => $model->quantity,
                    'price' => $model->price,
                    'total_price' => $price,
                ];
            }
        }
        return [
            'success' => false,
            'message' => "",
            'qty' => 0
        ];
    }
    public function actionRemoveQuantity($product_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $product = Product::find()->where(['idProd' => $product_id])->one();
        if (!empty($product)) {
            $user_id = Yii::$app->user->id;
            $model = ShoppingCart::find()->where(['product_id' => $product_id, 'user_id' => $user_id])->one();

            if (!empty($model)) {
                $model->quantity = $model->quantity - 1;
                $model->price = $product->price * $model->quantity;
                $model->save();
                $total_price = ShoppingCart::find()
                    ->select(['SUM(price)'])
                    ->where(['user_id' => $user_id,]);
                $price = $total_price->SUM('price');
                return [
                    'success' => true,
                    'message' => "",
                    'qty' => $model->quantity,
                    'price' => $model->price,
                    'total_price' => $price,
                ];
            }
        }
        return [
            'success' => false,
            'message' => "",
            'qty' => 0
        ];
    }


    public function actionRemoveFromCart($product_id)

    {
        $user_id = Yii::$app->user->id;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = ShoppingCart::deleteAll(['product_id' => $product_id, 'user_id' => $user_id]);
        $total_price = ShoppingCart::find()
            ->select(['SUM(price)'])
            ->where(['user_id' => $user_id,]);
        $price = $total_price->SUM('price');
        if (!empty($model)) {
            return [
                'success' => true,
                'message' => "deleted successfully",
                'total_price' => $price,
            ];
        }
        return [
            'success' => false,
            'message' => "Error 404",
        ];
    }
}
