<?php

namespace backend\controllers;

use common\models\ShoppingCart;
use common\models\Product;
use common\models\Order;
use common\models\User;
use Yii;
use yii\web\Controller;

class DetailsController extends Controller
{

    public function actionDetails()
    {
        $today = date('Y-m-d');
        $new_user = User::find()->where(['join_date' => $today])->count();
        $new_order = Order::find()->where(['date' => $today])->count();
        $confirmed_new_order = Order::find()->where(['date' => $today, 'order_status' => 'confirmed'])->count();

        $money_made = Order::find()
            ->where(['date' => new \yii\db\Expression('CURRENT_DATE'), 'order_status' => 'confirmed'])
            ->sum('total_cost');

        return $this->render('details', [
            'new_user' => $new_user,
            'new_order' => $new_order,
            'confirmed_new_order' => $confirmed_new_order,
            'money_made' => $money_made,
        ]);
    }
}
