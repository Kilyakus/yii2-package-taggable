<?php
namespace kilyakus\package\taggable\models;

class TagAssign extends \kilyakus\modules\components\ActiveRecord
{
    public static function tableName()
    {
        return 'tags_assign';
    }
}