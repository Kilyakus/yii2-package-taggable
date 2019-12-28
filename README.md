# How to use:

if u use yii2-module-base, just import "kilyakus\package\taggable\TaggableModule" on the modules page

# In all other cases:

add this to your config:

```
'tags' => [
    'class' => 'kilyakus\package\taggable\TaggableModule',
],
```

and use '/tags/list/index?query=' link to get tags

# Or

add this to your controller.

----------------------------------------------------------------------------

public function actions()
{
    return [
        'list' => [
            'class' => \kilyakus\package\taggable\actions\SearchAction::className()
        ]
    ];
}

and use '/...(your controller page)/list/index?query=' link to get tags