<?php

namespace Dmandrade\FormBuilder\Fields;

class CkeditorType extends FormField
{

    protected function getTemplate()
    {
        return 'ckeditor';
    }


    protected function getDefaults()
    {

        return [
        ];
    }
}