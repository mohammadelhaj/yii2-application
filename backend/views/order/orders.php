<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use common\models\Order;
?>
<?php $dataProvider = new ActiveDataProvider([
        'query' => Order::find()->where(['order_status' => ['==', 'pending']]),
        // 'pagination' => [
        //     'pageSize' => 20,
        // ],
    ]);

    ?>
    <?= GridView::widget([
        'layout' => "{items}\n{pager}",
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'user_id',
            'first_name',
            'last_name',
            'address',
            'total_cost',
            'date',
            'order_status',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Controle',
                'template' => '{view} {delete}',
                'urlCreator' => function ($action, $model) {
                    if ($action === 'view') {
                        return ['order/view-order', 'order_id' => $model->id];
                    }
                    if ($action === 'delete') {
                        return ['order/remove-order', 'order_id' => $model->id];
                    }
                },
            ],
        ],
    ]) ?>