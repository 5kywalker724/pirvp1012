<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ExhibitForm extends Model
{
    public $title;
    public $desc;
    public $quantity;


    public function rules()
    {
        return [
            [['title', 'desc', 'quantity'], 'required'],
            ['title', 'string', 'min' => 5, 'max' => 50],
            ['desc', 'string', 'max' => 255],
            ['quantity', 'number', 'min' => 1],
        ];
    }

    public function create()
    {
        if(!$this->validate())
        {
            return null;
        }

        $exhibit = new Exhibit();
        $exhibit->title = $this->title;
        $exhibit->desc = $this->desc;
        $exhibit->quantity = $this->quantity;

        return $exhibit->save() ? $exhibit : null;
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название экспоната',
            'desc' => 'Описание',
            'quantity' => 'Количество',
        ];
    }
}
