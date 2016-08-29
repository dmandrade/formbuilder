<?php

namespace Dmandrade\FormBuilder\Fields;

class DatePickerType extends FormField
{

    protected function getTemplate()
    {
        return 'datepicker';
    }


    protected function getDefaults()
    {
        return [
            'range' => false,
            'format' => 'mm/dd/yyyy',
            'autoclose' => true,
            'todayHighlight' => true
        ];
    }
}