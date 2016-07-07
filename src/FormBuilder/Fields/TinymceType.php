<?php

namespace Dmandrade\FormBuilder\Fields;

class TinymceType extends FormField
{

    protected function getTemplate()
    {
        return 'tinymce';
    }


    protected function getDefaults()
    {

        return [
            'moxiemanager' => (\File::exists(public_path($this->formHelper->getConfig('moxy_manager_path'))) ? $this->formHelper->getConfig('moxy_manager_path') : false),

        ];
    }
}