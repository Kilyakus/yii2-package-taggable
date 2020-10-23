<?php
namespace kilyakus\package\taggable\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

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

	public function search($params)
	{
		$query = static::find();

		$dataProvider = new ActiveDataProvider(['query' => $query]);
		$dataProvider->sort->defaultOrder = ['frequency' => SORT_DESC];
		$dataProvider->pagination->pageSize = Yii::$app->session->get('per-page', 20);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere(['like', 'name', $this->name]);

		return $dataProvider;
	}
}