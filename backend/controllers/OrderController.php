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
use common\models\Items;
use common\models\Order;

class OrderController extends Controller
{

    public function actionGetOrders()
    {
        return $this->render('orders');
    }
    public function actionViewOrder($order_id)
    {
        // $items = Items::find()
        // ->innerJoin([''])
        // ->where()
        // ->all();
        // $items[0]->price;
        $query = "SELECT items.*, product.*, items.price as
                    item_price 
                    FROM items 
                    INNER JOIN product 
                    ON items.product_id =product.idProd 
                    WHERE items.`status` != 'confirmed' AND items.order_id = $order_id;";
        $data = Yii::$app->db->createCommand($query)->queryAll();
        $quer = Items::find()
            ->select(['items.*', 'product.*', 'items.price as item_price'])
            ->innerJoin('product', 'items.product_id = product.idProd')
            ->where(['!=', 'items.status', 'confirmed'])
            ->andWhere(['items.order_id' => $order_id])
            ->all();


        // echo "<pre>";
        // print_r($data);
        // echo "__________________________________________________________";
        // print_r($quer);
        // echo "</pre>";
        // exit;

        $query2 = "SELECT first_name , last_name from `order` WHERE id=$order_id";
        $data2 = Yii::$app->db->createCommand($query2)->queryAll();

        $quer2 = Order::find()
            ->select(['first_name', 'last_name'])
            ->where(['id' => $order_id])
            ->all();

        // echo "<pre>";
        // print_r($data2);
        // echo "__________________________________________________________";
        // print_r($quer2);
        // echo "</pre>";
        // exit;
        $first_name = $data2[0]['first_name'];

        $last_name = $data2[0]['last_name'];

        return $this->render('view-order', [
            'model' => $data,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'order_id' => $order_id,

        ]);
    }
    public function actionConfirmOrder($order_id)
    {
        $updated = Yii::$app->db->createCommand()
            ->update('order', ['order_status' => 'confirmed'], ['id' => $order_id])
            ->execute();
        $updated2 = Yii::$app->db->createCommand()
            ->update('items', ['status' => 'confirmed'], ['order_id' => $order_id])
            ->execute();
        return $this->render('orders');
    }
    public function actionDeclineOrder($order_id)
    {
        $updated = Yii::$app->db->createCommand()
            ->update('order', ['order_status' => 'declined'], ['id' => $order_id])
            ->execute();
        $updated2 = Yii::$app->db->createCommand()
            ->update('items', ['status' => 'declined'], ['order_id' => $order_id])
            ->execute();
        return $this->render('orders');
    }
    public function actionRemoveOrder($order_id)
    {
        $deleted = Yii::$app->db->createCommand()
            ->delete('order', ['id' => $order_id])
            ->execute();
        return $this->render('orders');
    }
}
