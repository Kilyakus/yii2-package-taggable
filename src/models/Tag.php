<?php
namespace kilyakus\package\taggable\models;

class Tag extends \kilyakus\modules\components\ActiveRecord
{
    public static function tableName()
    {
        return 'tags';
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['frequency', 'integer'],
            ['name', 'string', 'max' => 64],
        ];
    }
}