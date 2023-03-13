<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use common\models\ShoppingCart;
use common\models\Product;
use common\models\Order;
use common\models\Items;

class MyOrdersController extends Controller
{
    public function actionMyOrders($user_id)

    {
        $order = Order::find()->where(['user_id' => $user_id])->all();

        return $this->render('my-orders', [
            'model' => $order,
        ]);
    }
    public function actionOrderDetail($order_id)
    {
        $query = "SELECT items.*, product.*, items.price as
                    item_price 
                    FROM items 
                    INNER JOIN product 
                    ON items.product_id =product.idProd WHERE items.order_id = $order_id;";
        $data = Yii::$app->db->createCommand($query)->queryAll();

        $quer2 = Items::find()
            ->select('items.*, product.*, items.price as item_price')
            ->innerJoin('product', 'items.product_id= product.idProd')
            ->where(['items.order_id' => $order_id])
            ->all();


        // echo "<pre>";
        // print_r($data);
        // echo "__________________________________________________________";
        // print_r($quer2);
        // echo "</pre>";
        // exit;

        $query2 = "SELECT first_name , last_name from `order` WHERE id=$order_id";
        $data2 = Yii::$app->db->createCommand($query2)->queryAll();
        $quer2 = Order::find()
            ->select('first_name , last_name')
            ->where(['id' => $order_id]);
        $first_name = $data2[0]['first_name'];
        $last_name = $data2[0]['last_name'];

        return $this->render('view-order', [
            'model' => $data,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'order_id' => $order_id,

        ]);
    }
}
