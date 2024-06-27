<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Inventory extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%inventory}}';
    }

}
