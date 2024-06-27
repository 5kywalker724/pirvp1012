<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\models\CreateroomForm;
use app\models\Room;
use app\models\CreateformalizeForm;
use app\models\RoomBooking;
use app\models\User;

class RoomController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'book', 'formalization'],
                'rules' => [
                    [
                        'actions' => ['create', 'book', 'formalization'],
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
        $rooms = Room::find()->all();

        return $this->render('index', ['rooms' => $rooms]);
    }

    public function actionCreate()
    {
        if(Yii::$app->user->identity->role === 1)
        {
            $model = new CreateroomForm();

            if($model->load(Yii::$app->request->post())){
                $model->create();

                return $this->goHome();
            }

            return $this->render('create', ['model' => $model]);
        }

        return $this->goHome();
    }

    public function actionBook($id)
    {
        if(!Yii::$app->user->isGuest)
        {
            $room = Room::findOne($id);

            if ($room === null || $room->seats === 0) {
                return $this->goHome();
            }

            $book = new RoomBooking();
            $book->user_id = Yii::$app->user->identity->id;
            $book->room_id = $room->id;
            $room->seats -= 1;

            $book->save();
            $room->save();

            return $this->goHome();
        }

        return $this->goHome();
    }

    public function actionFormalization()
    {
        if(Yii::$app->user->identity->role === 1)
        {
            $model = new CreateformalizeForm();

            $room_bookings = RoomBooking::find()->all();
            $users = [];
            $rooms = [];
            $message = '';

            foreach($room_bookings as $room_booking)
            {
                $users[] = User::find()->where(['id' => $room_booking->user_id])->one();
                $rooms[] = Room::find()->where(['id' => $room_booking->room_id])->one();
            }

            $users_helper = ArrayHelper::map($users, 'id', 'username');
            $rooms_helper = ArrayHelper::map($rooms, 'id', 'title');

            if($model->load(Yii::$app->request->post()))
            {
                if($model->formalize() === null)
                {
                    $message = 'Выбранный номер не относится к пользователю!';
                    return $this->render('formalization', ['model' => $model, 'users' => $users_helper, 'rooms' => $rooms_helper, 'message' => $message]);
                }
                return $this->goHome();
            }

            return $this->render('formalization', ['model' => $model, 'users' => $users_helper, 'rooms' => $rooms_helper, 'message' => $message]);
        }

        return $this->goHome();
    }

    public function actionResident()
    {
        $room_bookings = RoomBooking::find()->all();
        $users = [];
        $uniqueUserIds = [];

        foreach($room_bookings as $room_booking)
        {
            if($room_booking->formalization === 'Да' && !in_array($room_booking->user_id, $uniqueUserIds))
            {
                $users[] = User::find()->where(['id' => $room_booking->user_id])->one();
                $uniqueUserIds[] = $room_booking->user_id;
            }
        }

        return $this->render('resident', ['users' => $users]);

    }
}
