<?php

namespace app\models;

use Yii;
use yii\base\Model;

class InventoryForm extends Model
{
    public $title;

    public function rules()
    {
        return [
            [['title'], 'required'],
        ];
    }

    public function create()
    {
        if(!$this->validate())
        {
            return null;
        }

        $inventory = new Inventory();
        $exhibit = Exhibit::findOne(['title' => $this->title]);

        $inventory->title = $this->title;

        if($exhibit !== null)
        {
            $inventory->quantity = $exhibit->quantity;
        }

        return $inventory->save() ? $inventory : null;
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название экспоната'
        ];
    }
}
