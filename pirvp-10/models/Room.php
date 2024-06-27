<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Post model
 *
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $seats
 */
class Room extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%room}}';
    }
}
