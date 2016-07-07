<?php

return [
    'defaults' => [
        'wrapper_class' => 'form-group',
        'wrapper_error_class' => 'has-error',
        'label_class' => 'control-label',
        'field_class' => 'form-control',
        'help_block_class' => 'help-block',
        'error_class' => 'text-danger',
        'required_class' => 'required'
    ],
    'moxy_manager_path' => '/assets/moxiemanager/plugin.min.js',
    'tinymce_path' => '//cdn.tinymce.com/4/tinymce.min.js',
    'ckeditor_path' => 'js/vendor/ckeditor/ckeditor.js',
    // Templates
    'form' => 'form-builder::form.partial.form',
    'text' => 'form-builder::form.partial.text',
    'textarea' => 'form-builder::form.partial.textarea',
    'button' => 'form-builder::form.partial.button',
    'radio' => 'form-builder::form.partial.radio',
    'checkbox' => 'form-builder::form.partial.checkbox',
    'select' => 'form-builder::form.partial.select',
    'choice' => 'form-builder::form.partial.choice',
    'repeated' => 'form-builder::form.partial.repeated',
    'child_form' => 'form-builder::form.partial.child_form',
    'collection' => 'form-builder::form.partial.collection',
    'static' => 'form-builder::form.partial.static',
    'tinymce' => 'form-builder::form.partial.tinymce',
    'ckeditor' => 'form-builder::form.partial.ckeditor',
    'tag' => 'form-builder::form.partial.tag',
    'choice_area' => 'form-builder::form.partial.choice_area',
    'address_picker' => 'form-builder::form.partial.address_picker',
    'choice_ajax' => 'form-builder::form.partial.choice_ajax',
    'datepicker' => 'form-builder::form.partial.datepicker',
    'upload' => 'form-builder::form.partial.upload',
    'tabs' => 'form-builder::form.partial.tabs',

    // Remove the laravel-form-builder:: prefix above when using template_prefix
    'template_prefix' => '',

    'default_namespace' => '',

    'custom_fields' => [
//        'datetime' => App\Forms\Fields\Datetime::class
    ]
];
