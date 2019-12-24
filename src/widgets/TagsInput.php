<?php
namespace kilyakus\package\taggable\widgets;

use Yii;
use yii\helpers\Url;
use kilyakus\widget\selectize\SelectizeTextInput;

class TagsInput extends SelectizeTextInput
{
	public $options = ['class' => 'form-control'];
	public $loadUrl;
	public $clientOptions = [
		'plugins' => ['remove_button'],
		'valueField' => 'name',
		'labelField' => 'name',
		'searchField' => ['name'],
		'create' => true,
	];

	public function init()
	{
		if( empty($this->loadUrl)) {

			if( !empty(Yii::$app->getModule('tags')) ){

				$this->loadUrl[] = Url::toRoute('/tags/list/index');

			}elseif( 

				file_exists(Yii::getAlias('@vendor') . '/kilyakus/yii2-module-base/src/AdminModule.php') && 

				(
					Yii::$app->getModule('system') || 
					Yii::$app->getModule('admin')
				) &&

				(
					isset(Yii::$app->getModule('system')->activeModules['tags']) || 
					isset(Yii::$app->getModule('admin')->activeModules['tags'])
				)

			){

				$this->loadUrl[] = Url::toRoute('/system/tags/list/index');

			}

		}

		parent::init();
	}
}