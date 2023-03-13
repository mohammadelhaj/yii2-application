<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

 $languages = ['fr', 'en'];
?>

<?php $form = ActiveForm::begin(); ?>

<div style="margin: 10px;">
<?php foreach($languages as $language){
    echo $form->field($model, "product_name_{$language}")->textInput();
    echo $form->field($model, "details_{$language}")->textInput();
} ?>


    <?= $form->field($model, 'productName')->textInput() ?>
    <?= $form->field($model, 'price')->input('number') ?>

    <?= $form->field($model, 'description')->textInput() ?>
    <?= $form->field($model, 'category')->dropDownList([
        ArrayHelper::map($model2, 'idCat', 'categoryName'),

    ], [
        'prompt' => 'Select category',
    ]) ?>

    <?= $form->field($model, 'img1')->fileInput() ?>
    <?= $form->field($model, 'created_by')->textInput(['value' => Yii::$app->user->id]) ?>
    <?= $form->field($model, 'date')->input('datetime-local', ['value' => date('Y-m-d\TH:i')]) ?>
    <?= print_r($model->errors)  ?>
</div>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>