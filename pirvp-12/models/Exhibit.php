<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Exhibit extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%exhibit}}';
    }

}
