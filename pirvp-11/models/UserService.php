<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserService extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%user_service}}';
    }

}
