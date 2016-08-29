<?php
namespace Dmandrade\FormBuilder\Contracts;

use Illuminate\Http\Request;

interface FormContract
{

    public function getEdit($id);

    public function postEdit(Request $request);
}