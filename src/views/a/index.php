<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;
use kilyakus\widget\grid\GridView;
use kilyakus\helper\media\Image;
use kilyakus\widget\fancybox\Fancybox;
use kilyakus\web\widgets as Widget;
use yii\web\JsExpression;
use bin\admin\models\Photo;
use bin\admin\components\API;

$this->title = Yii::t('easyii', 'Tags');

$gridColumns = [
	['class' => 'kilyakus\widget\grid\SerialColumn'],
	[
		'class' => 'kilyakus\widget\grid\EditableColumn',
		'attribute' => 'name',
		'pageSummary' => 'Page Total',
		'vAlign' => 'middle',
		'contentOptions' => ['class'=>'kv-sticky-column'],
		'editableOptions'=>[
			'header' => Yii::t('easyii', 'Name'),
			'size' => 'md'
		]
	],
	[
		'class' => 'kilyakus\widget\grid\ActionColumn',
		'header' => '',
		'template' => '{actions}',
		'buttons' => [
			'actions' => function ($url, $model) {
				$module = $this->context->module->module->id;
				if(IS_MODER) {
					return Widget\Dropdown::widget([
						'button' => [
							'icon' => 'fa fa-cog',
							'iconPosition' => Widget\Button::ICON_POSITION_LEFT,
							'type' => Widget\Button::TYPE_PRIMARY,
							'disabled' => false,
							'block' => false,
							'outline' => true,
							'hover' => true,
							'circle' => true,
							'options' => [
								'title' => Yii::t('easyii', 'Actions'),
								'class' => 'btn-icon'
							]
						],
						'options' => ['class' => 'dropdown-menu-right'],
						'items' => [
							[
								'label' => Yii::t('easyii', 'Delete item'),
								'icon' => 'fa fa-times',
								'url' => Url::to(['/' . $module . '/photos/delete', 'id' => $model->primaryKey]),
								'linkOptions' => [
									'class' => 'confirm-delete',
									'data-reload' => '0',
									'data-pjax' => '0',
								],
							],
						],
					]);
				}
			}
		]
	],
];
echo GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => $gridColumns,
	// 'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
	'toolbar' =>  [
		['content'=>
			Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>Yii::t('kvgrid', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
			Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
		],
		'{export}',
		'{toggleData}'
	],
	'pjax' => true,
	'bordered' => false,
	'striped' => false,
	'condensed' => false,
	'responsive' => false,
	'hover' => true,
	'floatHeader' => true,
	'floatHeaderOptions' => ['top' => 60],
	'portlet' => [
		'title' => $this->title,
		'icon' => 'fa fa-' . $this->context->module->icon,
		'bodyOptions' => [
			'class' => ($dataProvider->query->count() <= 0) ?: 'kt-portlet__body--fit',
		],
		// 'footerContent' => \yii\widgets\LinkPager::widget([
		//	 'pagination' => $data->pagination
		// ]),
		'pluginSupport' => false,
	],
]);
?>