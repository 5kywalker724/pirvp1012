<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Room;

class CreateroomForm extends Model
{
    public $title;
    public $desc;
    public $seats;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'desc', 'seats'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 255],
            [['seats'], 'number', 'min' => 1, 'max' => 10],
        ];
    }

    public function create()
    {
        if (!$this->validate()) {
            return null;
        }

        $room = new Room();
        $room->title = $this->title;
        $room->desc = $this->desc;
        $room->seats = $this->seats;

        return $room->save() ? $room : null;

    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название номера',
            'desc' => 'Описание номера',
            'seats' => 'Количество мест в номере',
        ];
    }

}
