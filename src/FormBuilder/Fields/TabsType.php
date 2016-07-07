<?php

namespace Dmandrade\FormBuilder\Fields;

class TabsType extends FormField
{
    private $currentTab = null;

    public function addTab($name)
    {
        $this->currentTab = $this->_prepareKey($name);
        $this->options['tabs'][$this->currentTab] = [
            'name' => $name,
            'fields' => []
        ];

        return $this;
    }

    protected function _prepareKey($name)
    {
        return strtolower(str_replace(' ', '_', $name));
    }

    public function active($name)
    {
        $this->options['active'] = $this->_prepareKey($name);

        return $this;
    }

    public function add($name, $type = 'text', array $options = [], $modify = false)
    {
        /** @var FormField $field */
        $field = $this->getParent()->add($name, $type, $options, $modify, false);;
        $this->options['tabs'][$this->currentTab]['fields'][$field->getRealName()] = $field;

        return $field;
    }

    protected function getTemplate()
    {
        return 'tabs';
    }

    protected function getDefaults()
    {
        return [
            'tabs' => []
        ];
    }
}
