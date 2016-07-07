<?php

namespace Dmandrade\FormBuilder\Fields;

class AddressPickerType extends FormField
{

    /**
     * @param $tabName
     * @param $tabId
     */
    public function addTab($tabName, $tabId){
        $this->options['tabs'][$tabId] = array(
            'name' => $tabName,
            'fields' => []
        );
    }

    /**
     * @param FormField $field
     * @param $tabId
     */
    public function add(FormField $field, $tabId){
        $this->options['tabs'][$tabId]['fields'][] = $field;
    }

    protected function getTemplate()
    {
        return 'address_picker';
    }

    protected function getDefaults()
    {
        return [
            'tabs' => []
        ];
    }
}
