<?php
namespace kilyakus\package\taggable\widgets;

use kilyakus\widget\selectize\SelectizeTextInput;

class TagsInput extends SelectizeTextInput
{
    public $options = ['class' => 'form-control'];
    public $loadUrl = ['/tags/list/search'];
    public $clientOptions = [
        'plugins' => ['remove_button'],
        'valueField' => 'name',
        'labelField' => 'name',
        'searchField' => ['name'],
        'create' => true,
    ];
}