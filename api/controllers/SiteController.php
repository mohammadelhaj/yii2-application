<?php

namespace api\controllers;

use common\models\LoginForm;
use Yii;
use yii\rest\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function actionIndex(){
        // throw new ForbiddenHttpException("You are not allowed");
        return [
            "name"=>'Mohamad'
        ];
    }    
    public function actionLogin()
    {
        $model = new LoginForm();
        if($model->load(Yii::$app->request->post(),'')){
            if($model->login()){
                $user= $model->getUser();
                $user->access_token = Yii::$app->security->generateRandomString(64);
                $user->save();
                return ['access_token'=>$user->access_token,'id'=> $user->id];
            }
        }
       throw new ForbiddenHttpException("Invalid Username Or Password");
    }

    public function actionError()
    {
        $exception =  Yii::$app->getErrorHandler()->exception;
        return [
            'status'=> $exception->statusCode,
            'code'=> $exception->getCode(),
            'message'=> $exception->getMessage(),
            'file'=> $exception->getFile(),
            'line'=> $exception->getLine(),
            'stack-trace'=> $exception->getTraceAsString(),
        ];
    }
}
