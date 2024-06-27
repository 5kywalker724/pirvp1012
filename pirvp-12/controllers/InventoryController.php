<?php

namespace app\controllers;

use app\models\InventoryForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Inventory;

class InventoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'index'],
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
        $inventories = Inventory::find()->all();

        return $this->render('index', ['inventories' => $inventories]);
    }

    public function actionCreate()
    {
        $model = new InventoryForm();

        if($model->load(Yii::$app->request->post()))
        {
            $model->create();
            return $this->goHome();
        }

        return $this->render('create', ['model' => $model]);
    }
}
