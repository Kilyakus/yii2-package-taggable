<?php
namespace kilyakus\package\taggable\actions;

use Yii;
use yii\web\Response;
use yii\helpers\Html;
use kilyakus\action\BaseAction as Action;
use kilyakus\package\taggable\models\Tag;

class SearchAction extends Action
{
    public function run($query)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $items = [];
        $query = urldecode(mb_convert_encoding($query, "UTF-8"));
        foreach (Tag::find()->where(['like', 'name', $query])->asArray()->all() as $tag) {
            $items[] = ['name' => $tag['name']];
        }

        return $items;
    }
}