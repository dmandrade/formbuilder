<?php namespace Dmandrade\FormBuilder\Facades;

use Illuminate\Support\Facades\Facade;

class FormBuilder extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'form-builder';
    }
}
