<?php


namespace frontend\models;


use yii\db\ActiveRecord;


class Customer extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%customers}}';
    }

    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'address'], 'required'],
            [['name', 'surname', 'email', 'address'], 'string', 'max' => 255],
            [['name', 'surname', 'email', 'address'], 'filter', 'filter' => 'strip_tags'],
            [['name', 'surname', 'email', 'address'], 'filter', 'filter' => 'trim'],
            ['email', 'email'],
        ];
    }

}