<?php
namespace api\controllers;

use common\models\User;
use Yii;
use yii\filters\auth\HttpHeaderAuth;
use yii\rest\Controller;

class MeController extends Controller{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpHeaderAuth::class,
        ];
        return $behaviors;
    }

    public function actionProfile(){
        $user = Yii::$app->user->getIdentity();
        //$user = User::find()->where(['id'=> Yii::$app->request->get("id")])->one();
        return $user;
    }
}