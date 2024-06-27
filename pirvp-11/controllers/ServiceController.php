<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\CreateserviceForm;
use app\models\Service;
use app\models\UserService;

class ServiceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'order'],
                'rules' => [
                    [
                        'actions' => ['create', 'order'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
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
        $services = Service::find()->all();

        return $this->render('index', ['services' => $services]);
    }

    public function actionCreate()
    {
        if(Yii::$app->user->identity->role === 1){

            $model = new CreateserviceForm();

            if($model->load(Yii::$app->request->post())){
                $model->create();
                return $this->goHome();
            }

            return $this->render('create', ['model' => $model]);
        }

        return $this->goHome();
    }

    public function actionOrder($id)
    {
        if(!Yii::$app->user->isGuest)
        {
            $service = Service::findOne($id);

            if($service === null)
            {
                return $this->goHome();
            }

            $user_service = new UserService();
            $user_service->user_id = Yii::$app->user->identity->id;
            $user_service->service_id = $service->id;

            $user_service->save();

            return $this->goHome();
        }

        return $this->goHome();
    }

    public function actionProvide()
    {
        $user_services = UserService::find()->all();

        return $this->render('provide', ['user_services' => $user_services]);
    }
}
