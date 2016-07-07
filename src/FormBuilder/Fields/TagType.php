<?php

namespace Dmandrade\FormBuilder\Fields;

class TagType extends FormField
{

    protected function getTemplate()
    {
        return 'tag';
    }


    protected function getDefaults()
    {
        return [
            'default_value' => ''
        ];
    }
}