<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Post model
 *
 * @property integer $id
 * @property string $user_id
 * @property string $room_id
 * @property string $formalization
 */
class RoomBooking extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%room_booking}}';
    }
}
