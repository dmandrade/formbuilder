<?php

namespace Dmandrade\FormBuilder\Fields;

class DatePickerType extends FormField
{

    /**
     * Get the type of the field
     *
     * @return string
     */
    public function getType()
    {
        return 'text';
    }

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