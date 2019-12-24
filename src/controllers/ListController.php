<?php
namespace kilyakus\package\taggable\controllers;

use Yii;
use kilyakus\package\taggable\actions\SearchAction;

class ListController extends \yii\web\Controller
{
    public function actions() {
        return [
            'index' => SearchAction::className(),
        ];
    }
}