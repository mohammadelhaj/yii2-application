<?php

namespace api\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\auth\HttpHeaderAuth;

use common\models\Order;
use common\models\Items;

class MyOrdersController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpHeaderAuth::class,
        ];
        return $behaviors;
    }
    public function actionMyOrders($user_id)

    {
        $order = Order::find()->where(['user_id' => $user_id])->all();
        return [
            'model' => $order,
        ];
    }
    public function actionOrderDetail($order_id)
    {
        $query = "SELECT items.*, product.*, items.price as
                    item_price 
                    FROM items 
                    INNER JOIN product 
                    ON items.product_id =product.idProd WHERE items.order_id = $order_id;";
        $data = Yii::$app->db->createCommand($query)->queryAll();

        $query2 = "SELECT first_name , last_name from `order` WHERE id=$order_id";
        $data2 = Yii::$app->db->createCommand($query2)->queryAll();
        $first_name = $data2[0]['first_name'];
        $last_name = $data2[0]['last_name'];

        return [
            'model' => $data,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'order_id' => $order_id,
        ];
    }
}
