<?php namespace Dmandrade\FormBuilder\Fields;

class SelectType extends FormField
{

    protected $valueProperty = 'selected';

    public function getDefaults()
    {
        return [
            'choices' => [],
            'empty_value' => null,
            'selected' => null
        ];
    }

    protected function getTemplate()
    {
        return 'select';
    }
}
