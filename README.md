# How to use:

If u are using yii2-module-base, just import "kilyakus\package\taggable\TaggableModule" on the modules page

# In all other cases:

Add this to your config:

```
'tags' => [
	'class' => 'kilyakus\package\taggable\TaggableModule',
],
```

and use '/tags/list/index?query=' link to get tags

# Or

Add this to your controller.

```
public function actions()
{
	return [
		'list' => [
			'class' => \kilyakus\package\taggable\actions\SearchAction::className()
		]
	];
}
```

and use '/...(your controller page)/list/index?query=' link to get tags