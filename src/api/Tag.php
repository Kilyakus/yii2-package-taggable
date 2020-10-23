<?php
namespace kilyakus\package\taggable\api;

use Yii;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\ArrayHelper;
use kilyakus\package\taggable\models\Tag as TagModel;
use kilyakus\package\taggable\models\TagAssign;

class Tag extends \kilyakus\modules\components\API
{
    public function api_list($options = [])
    {
        $options['groupBy'] = ['tag_id'];

        $match = ArrayHelper::map($this->api_match($options), 'id', 'tag_id');

        $options = ['where' => ['tag_id' => $match]];

        return $this->findTags($options);
    }

	public function api_match($options = [])
	{
		$tags = $this->findTags($options);

		$tagIds = ArrayHelper::getColumn($tags, 'tag_id');

		return $this->findMatches($options, $tagIds);
	}

	private function findTags($options = [])
	{
        $query = TagModel::find();

        if(!empty($options['where'])){

            foreach ($options['where'] as $column => $value) {
                if(!$this->allowedColumns(TagModel::tableName(), $column)){
                    unset($options['where'][$column]);
                }

                if($column == 'name'){
                    $options['where'][$column] = preg_split('/[^a-z0-9]+/', $options['where'][$column]);
                }
            }

            $query->andFilterWhere($options['where']);
        }

        if(!empty($options['orderBy'])){
            $query->orderBy($options['orderBy']);
        }else{
            $query->orderBy(['frequency' => SORT_DESC]);
        }

		return $query->all();
	}

	private function findMatches($options = [], $tagIds)
	{
		$query = TagAssign::find()->where(['tag_id' => $tagIds]);

		if(!empty($options['where'])){

            foreach ($options['where'] as $column => $value) {
                if(!$this->allowedColumns(TagAssign::tableName(), $column) || $column == 'tag_id'){
                    unset($options['where'][$column]);
                }
            }

			$query->andFilterWhere($options['where']);
		}

        if(!empty($options['groupBy'])){
            $query->groupBy($options['groupBy']);
        }

		return $query->all();
	}

    private function allowedColumns($tableName, $columnIsset)
    {
        return in_array($columnIsset, array_keys(Yii::$app->db->getTableSchema($tableName, true)->columns));
    }
}