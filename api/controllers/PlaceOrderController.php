<?php

namespace api\controllers;

use common\models\Items;
use common\models\ShoppingCart;
use common\models\Product;
use yii\filters\auth\HttpHeaderAuth;
use common\models\Order;
use Yii;

use yii\rest\Controller;
use yii\web\ServerErrorHttpException;

class PlaceOrderController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpHeaderAuth::class,
        ];
        return $behaviors;
    }
    public function actionCheckOut()
    {
        $user_id = Yii::$app->user->id;
        // $data = Product::find()
        //     ->select(['product.*', '`shopping-cart`.*'])
        //     ->innerJoin('`shopping-cart`', 'product.idProd = `shopping-cart`.product_id')
        //     ->where(['!=', '`shopping-cart`.quantity', 0])
        //     ->all();
        $cartProducts = ShoppingCart::find()
            ->with(['product'])
            ->where(['user_id' => Yii::$app->user->id])
            ->all();
        $products = [];
        $count = 0;
        $total = 0;
        foreach ($cartProducts as $cartProduct) {
            //$products[] = $cartProduct->getProduct()->one();
            $products[] = [
                'product' => $cartProduct->product,
                'quantity' => $cartProduct->quantity,
                'price' => $cartProduct->quantity * $cartProduct->product->price
            ];
            $count += $cartProduct->quantity;
            $total += $cartProduct->quantity * $cartProduct->product->price;
        }
        return [
            'products' => $products,
            'total' => $total,
            'count' => $count
        ];
    }
    public function actionPlaceOrder()
    {
        $user_id = Yii::$app->user->id;
        $model = new Order();
        $model->user_id = $user_id;

        $shopping_carts = ShoppingCart::find()->where(['user_id' => $user_id])->all();
        if (!empty($shopping_carts)) {
            if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
                foreach ($shopping_carts as $shopping_cart) {
                    if ($shopping_cart->quantity > 0) {
                        $item = new Items();
                        $item->product_id = $shopping_cart->product_id;
                        $item->user_id = $shopping_cart->user_id;
                        $item->quantity = $shopping_cart->quantity;
                        $item->price = $shopping_cart->price;
                        $item->status = "pending";
                        $item->order_id = $model->id;
                        $item->save();
                    }
                }
                ShoppingCart::deleteAll(['user_id' => $user_id]);
                return $model;

                //     $delete_from_shopping_cart = "DELETE FROM `shopping-cart` WHERE user_id =" . Yii::$app->user->id;
                //     $exec = Yii::$app->db->createCommand($delete_from_shopping_cart)->queryAll();
                //     return [
                //         'model' => "haj",
                //     ];
            }
            return $model->errors;
        }
        throw new ServerErrorHttpException("Shopping cart is empty");
    }
}
