<?php
namespace kilyakus\package\taggable;

use kilyakus\modules\components\Module as BaseModule;

class TaggableModule extends BaseModule
{
    public $urlPrefix = 'tags';

    public $dbConnection = 'db';

    public $icon;
    
    public $settings = [];

    public $redirects = [];

    public static $installConfig = [
        'title' => [
            'en' => 'Tags',
            'ru' => 'Теги',
        ],
        'icon' => 'fa fa-tags',
        'order_num' => 70,
    ];

    public function getDb()
    {
        return \Yii::$app->get($this->dbConnection);
    }
}