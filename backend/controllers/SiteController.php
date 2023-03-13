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
use common\models\Product;
use yii\debug\models\search\Profile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        //'actions' => ['logout', 'index', 'signup','controle'],
                        'allow' => true,

                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $this->layout = 'blank';
        $model = new Admin();

        if ($model->load(Yii::$app->request->post())) {

            $admin = Admin::findOne(['username' => $model->username]);
            if ($admin && Yii::$app->getSecurity()->validatePassword($model->password_hash, $admin->password_hash)) {
                Yii::$app->user->login($admin);
                return $this->redirect(['index']);
            }
        }


        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $model = new Admin();
        $model->auth_key = Yii::$app->security->generateRandomString();


        if ($model->load(Yii::$app->request->post())) {
            $password = $model->password_hash;
            $model->password_hash = Yii::$app->security->generatePasswordHash($password);
            if ($model->save()) {
                Yii::$app->user->login($model);
                Yii::$app->session->setFlash('success', 'admin account created successfully');
                return $this->redirect(['index']);
            } else {
                return $this->render('signup', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
   
      
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->render('index');
    }
}
