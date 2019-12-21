<?php
namespace kilyakus\package\taggable\controllers;

/*
    How to use:

    add this to your config:

----------------------------------------------------------------------------

    'tags' => [
        'class' => 'kilyakus\package\taggable\TaggableModule',
    ],

----------------------------------------------------------------------------

    and use "/tags/list" to get tags, or add

----------------------------------------------------------------------------

    public function actions()
    {
        return [
            'list' => [
                'class' => \kilyakus\package\taggable\actions\ListAction::className()
            ]
        ];
    }

----------------------------------------------------------------------------

    to your controller.




    Or just use:

----------------------------------------------------------------------------

    extends \kilyakus\package\taggable\controllers\TagsController

----------------------------------------------------------------------------

    if u like crutches.

*/

class TagsController extends \yii\web\Controller
{
    public function actions() {
        return [
            'images' => [
                'class' => 'kilyakus\package\taggable\actions\UploadAction',
            ],
        ];
    }
}