<?php

namespace app\models;

use yii\base\Model;
use app\models\Service;

class CreateserviceForm extends Model
{
    public $title;
    public $desc;
    public $price;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'desc', 'price'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 255],
            [['price'], 'number', 'min' => 1000],
        ];
    }

    public function create()
    {
        if(!$this->validate()){
            return null;
        }

        $service = new Service();
        $service->title = $this->title;
        $service->desc = $this->desc;
        $service->price = $this->price;

        return $service->save() ? $service : null;
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название услуги',
            'desc' => 'Описание услуги',
            'price' => 'Стоимость услуги',
        ];
    }
}
