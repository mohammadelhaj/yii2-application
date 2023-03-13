<?php

namespace frontend\controllers;

use common\models\Items;
use common\models\ShoppingCart;
use common\models\Product;
use common\models\Order;
use Yii;
use yii\web\Controller;


class PlaceOrderController extends Controller
{
    public function actionCheckOut($user_id)
    {
        // $data = Product::find()
        //     ->select(['product.*', '`shopping-cart`.*'])
        //     ->innerJoin('`shopping-cart`', 'product.idProd = `shopping-cart`.product_id')
        //     ->where(['!=', '`shopping-cart`.quantity', 0])
        //     ->all();
        $order = new Order();
        $query = "SELECT *
        FROM product 
        INNER JOIN `shopping-cart`
        ON product.idProd= `shopping-cart`.product_id WHERE `shopping-cart`.quantity !=0 AND `shopping-cart`.user_id=$user_id";
        $data = Yii::$app->db->createCommand($query)->queryAll();

        $product = Product::find()
            ->innerJoin('`shopping-cart`', 'product.idProd= `shopping-cart`.product_id')
            ->where(['!=', '`shopping-cart`.quantity', 0])
            ->andWhere(['`shopping-cart`.user_id' => $user_id])
            ->all();
        // echo "<pre>";
        // print_r($data);
        // echo "__________________________________________________________";
        // print_r($product);
        // echo "</pre>";
        // exit;

        $query2 = "SELECT COUNT(*) FROM product 
        INNER JOIN `shopping-cart` ON product.idProd= `shopping-cart`.product_id 
        WHERE `shopping-cart`.quantity !=0 AND `shopping-cart`.user_id=$user_id ";
        $number_of_items = Yii::$app->db->createCommand($query2)->queryAll();

        $quer2 = Product::find()
            ->select(['COUNT(*)'])
            ->innerJoin('`shopping-cart`', 'product.idProd= `shopping-cart`.product_id')
            ->where(['>', '`shopping-cart`.quantity', 0])
            ->andWhere(['`shopping-cart`.user_id' => $user_id])
            ->all();
        $count = $number_of_items[0]['COUNT(*)'];

        // echo "<pre>";
        // print_r($number_of_items);
        // echo "__________________________________________________________";
        // print_r($quer2);
        // echo "</pre>";
        // exit;
        $total_price = ShoppingCart::find()
            ->select(['SUM(price)'])
            ->where(['user_id' => $user_id,])
            ->scalar();


        return $this->render('checkout', [
            'model' => $data,
            'total_price' => $total_price,
            'number_of_items' => $count,
            'order' => $order,


        ]);
    }
    public function actionPlaceOrder($user_id)
    {

        $model = new Order();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $shopping_carts = ShoppingCart::find()->where(['user_id' => $user_id])->all();

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


            $delete_from_shopping_cart = "DELETE FROM `shopping-cart` WHERE user_id =" . Yii::$app->user->id;
            $exec = Yii::$app->db->createCommand($delete_from_shopping_cart)->queryAll();


            yii::$app->getSession()->setFlash('success', 'you made your order');
            return $this->redirect(['../shopping-cart/shopping-cart', 'user_id' => Yii::$app->user->id]);
        } else {
            return $this->render('checkout', [
                'model' => $model,

            ]);
        }
    }
}
