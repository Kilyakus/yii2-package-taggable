<?php
namespace kilyakus\package\taggable\api;

use Yii;

use bin\admin\models\Tag;
use kilyakus\widget\fancybox\Fancybox\Fancybox;

class Taggable extends \bin\admin\components\API
{
    private $_tags;
    private $_last;

    public function api_last($limit = 1, $where = null)
    {
        if($limit === 1 && $this->_last){
            return $this->_last;
        }

        $result = [];

        $query = Tag::find()->limit($limit);
        if($where){
            $query->andWhere($where);
        }

        foreach($query->all() as $item){
            $tagObject = new TagObject($item);
            $tagObject->rel = 'last';
            $result[] = $tagObject;
        }

        if($limit > 1){
            return $result;
        }else{
            $this->_last = count($result) ? $result[0] : null;
            return $this->_last;
        }
    }

    public function api_get($id)
    {
        if(!isset($this->_tags[$id])) {
            $this->_tags[$id] = $this->findTag($id);
        }
        return $this->_tags[$id];
    }

    private function findTag($id)
    {
        return Tag::findOne($id);
    }
}