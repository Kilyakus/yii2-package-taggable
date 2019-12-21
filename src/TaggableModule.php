<?php
namespace kilyakus\package\taggable;

use yii\base\Module as BaseModule;

class TaggableModule extends BaseModule
{
    public $urlPrefix = 'tags';

    public $dbConnection = 'db';

    public function getDb()
    {
        return \Yii::$app->get($this->dbConnection);
    }
}