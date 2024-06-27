<?php

namespace app\controllers;

use app\models\ExhibitForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Exhibit;

class ExhibitController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {
        $exhibits = Exhibit::find()->all();

        return $this->render('index', ['exhibits' => $exhibits]);
    }

    public function actionCreate()
    {
        $model = new ExhibitForm();

        if($model->load(Yii::$app->request->post()))
        {
            $model->create();
            return $this->goHome();
        }

        return $this->render('create', ['model' => $model]);
    }
}
