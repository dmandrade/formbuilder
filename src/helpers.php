<?php

use Dmandrade\FormBuilder\Fields\FormField;
use Dmandrade\FormBuilder\Form;

\Collective\Html\HtmlBuilder::macro('buttonWithIcon', function($title, $options = []) {
    if (isset($options['icon'])){
        $icon = $options['icon'];
        unset($options['icon']);
    }
    return '<button '.$this->attributes($options).'>'.(isset($icon)?'<i class="fa fa-'.$icon.'"></i> ':'').$title.'</button>';
});

if (!function_exists('form')) {

    function form(Form $form, array $options = [])
    {
        return $form->renderForm($options);
    }

}

if (!function_exists('form_start')) {

    function form_start(Form $form, array $options = [])
    {
        return $form->renderForm($options, true, false, false);
    }

}

if (!function_exists('form_end')) {

    function form_end(Form $form, $showFields = true)
    {
        return $form->renderRest(true, $showFields);
    }

}

if (!function_exists('form_rest')) {

    function form_rest(Form $form)
    {
        return $form->renderRest(false);
    }

}

if (!function_exists('form_until')) {

    function form_until(Form $form, $field_name)
    {
        return $form->renderUntil($field_name, false);
    }

}

if (!function_exists('form_row')) {

    function form_row(FormField $formField, array $options = [])
    {
        return $formField->render($options);
    }

}

if (!function_exists('form_label')) {

    function form_label(FormField $formField, array $options = [])
    {
        return $formField->render($options, true, false, false);
    }

}

if (!function_exists('form_widget')) {

    function form_widget(FormField $formField, array $options = [])
    {
        return $formField->render($options, false, true, false);
    }

}

if (!function_exists('form_errors')) {

    function form_errors(FormField $formField, array $options = [])
    {
        return $formField->render($options, false, false, true);
    }

}

if (!function_exists('form_widget_view')) {

    function form_widget_view(FormField $formField, array $options = [])
    {
        return $formField->view($options, false, true, false);
    }

}

if (!function_exists('form_view')) {

    function form_view(Form $form, array $options = [])
    {
        return $form->renderFormView($options);
    }

}

if (!function_exists('form_rest_view')) {

    function form_rest_view(Form $form)
    {
        return $form->renderRestView();
    }

}
