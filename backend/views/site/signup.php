<?php



use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'email'); ?>
<?= $form->field($model, 'password_hash')->label('Password')->passwordInput(); ?>
<?= $form->field($model, 'status')->textInput(); ?>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']); ?>

<?php $form = ActiveForm::end(); ?>

