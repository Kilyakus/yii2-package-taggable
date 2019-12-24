# yii2-package-taggable

# How to use:

if u use yii2-module-base, just import "kilyakus\package\taggable\TaggableModule" on the modules page

# In all other cases:

add this to your config:

----------------------------------------------------------------------------

'tags' => [
    'class' => 'kilyakus\package\taggable\TaggableModule',
],

----------------------------------------------------------------------------

and use Url::to(['/tags/list/search', 'query' => '...']) to get tags, or add

----------------------------------------------------------------------------

public function actions()
{
    return [
        'list' => [
            'class' => \kilyakus\package\taggable\actions\SearchAction::className()
        ]
    ];
}

----------------------------------------------------------------------------

to your controller.




Or just use:

----------------------------------------------------------------------------

extends \kilyakus\package\taggable\controllers\ListController

----------------------------------------------------------------------------

if u like crutches.