<?php

namespace Dmandrade\FormBuilder\Fields;

class ChoiceAreaType extends FormField
{

    protected function getTemplate()
    {
        return 'choice_area';
    }


    protected function getDefaults()
    {
        return [
            'choices' => [],
            'selected' => []

        ];
    }
}