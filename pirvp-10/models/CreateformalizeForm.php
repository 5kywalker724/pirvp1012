<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CreateformalizeForm extends Model
{
    public $user_id;
    public $room_id;
    public $formalization;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'room_id', 'formalization'], 'required'],
            [['user_id'], 'exist', 'targetClass' => 'app\models\User', 'targetAttribute' => 'id'],
            [['room_id'], 'exist', 'targetClass' => 'app\models\Room', 'targetAttribute' => 'id'],
            [['formalization'], 'in', 'range' => ['Да']],
        ];
    }

    public function formalize()
    {
        if (!$this->validate()) {
            return null;
        }

        $room_booking = RoomBooking::find()->where(['user_id' => $this->user_id, 'room_id' => $this->room_id])->one();

        if($room_booking === null)
        {
            return null;
        }

        $room_booking->formalization = $this->formalization;

        return $room_booking->save() ? $room_booking : null;

    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'Пользователь',
            'room_id' => 'Номер',
            'formalization' => 'Подтвердить оформление брони номера',
        ];
    }

}
