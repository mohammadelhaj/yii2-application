<?php

use common\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
?>

<div class="col-md-12 border border-secondary text-center bg-danger text-white">
    <?= Html::a('Add a category', ['category/addcategory'], [
        'style' => 'text-decoration: none;color: black;'
    ])
    ?>
</div>

    <?php $dataProvider = new ActiveDataProvider([
        'query' => Category::find(),
        // 'pagination' => [
        //     'pageSize' => 20,
        // ],
    ]);

    ?>
    <?= GridView::widget([
        'layout' => "{items}\n{pager}",
        'dataProvider' => $dataProvider,
        'columns' => [
            'idCat',
            'categoryName',
            'categoryName',
            'created_by',
            'date',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Controle',
                'template' => '{view} {update} {delete}',
                'urlCreator' => function ($action, $model) {
                    if ($action === 'view') {
                        return ['category/view', 'category_id' => $model->idCat];
                    }
                    if ($action === 'update') {
                        return ['category/update', 'category_id' => $model->idCat];
                    }
                    if ($action === 'delete') {
                        return ['category/remove-category', 'category_id' => $model->idCat];
                    }
                },
            ],
        ],
    ]) ?>


