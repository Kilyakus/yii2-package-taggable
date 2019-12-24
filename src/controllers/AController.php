<?php
namespace kilyakus\package\taggable\controllers;

use Yii;
use yii\widgets\ActiveForm;
use kilyakus\package\gui\actions\DeleteAction;
use kilyakus\package\taggable\models\Tag;

class AController extends \kilyakus\modules\components\Controller
{
    public $moduleName = 'tags';
    public $viewRoute = '/a/tags';

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'model' => Tag::className(),
            ]
        ];
    }

    public function actionIndex()
    {
        if(!Yii::$app->request->post())
        {
            $searchModel  = \Yii::createObject(Tag::className());
            $dataProvider = $searchModel->search(\Yii::$app->request->get());

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        }else{
            return self::update();
        }
    }

    public function update()
    {
        $post = Yii::$app->request->post();
        $key = $post['editableKey'];
        $index = $post['editableIndex'];
        $attribute = $post['editableAttribute'];
        $attributes = $post['Tag'];
        $model = Tag::findOne($key);

        if (isset($post['hasEditable'])) {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($model->load($post)) {

                $model->{$attribute} = $attributes[$index][$attribute];
                $model->update();

                $success = [
                    'message' => Yii::t('easyii', 'Update success'),
                    'output' => [
                        $attribute => $model->{$attribute},
                    ]
                ];
            }
            else {

                $this->error = Yii::t('easyii', 'Update error. {0}', $model->formatErrors());

            }

            return $this->formatResponse($success);
        }
    }
}