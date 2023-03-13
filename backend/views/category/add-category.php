<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<div>
    <?= $form->field($model, 'categoryName')->textInput() ?>
    <?= $form->field($model, 'created_by')->textInput(['value' => Yii::$app->user->id]) ?>
    <?= $form->field($model, 'date')->input('datetime-local', ['value' => date('Y-m-d\TH:i')]) ?>

<?=print_r($model->errors)  ?>


</div>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>