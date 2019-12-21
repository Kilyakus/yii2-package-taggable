<?php
namespace kilyakus\package\taggable\controllers;

use kilyakus\package\taggable\actions\SearchAction;

class ListController extends \yii\web\Controller
{
    public function actions() {
        return [
            'search' => SearchAction::className(),
        ];
    }
}