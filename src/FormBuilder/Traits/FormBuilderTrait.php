<?php
namespace Dmandrade\FormBuilder\Traits;

use Dmandrade\FormBuilder\Form;
use Dmandrade\FormBuilder\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Response;

trait FormBuilderTrait
{

    /**
     * @var \Dmandrade\FormBuilder\Form $form
     * Injected by the constructor
     */
    protected $form;
    protected $model;

    /**
     * @var string
     */
    protected $redirectTo = null;

    /**
     * Create a Form instance
     *
     * @param string $name Full class name of the form class
     * @param array $options Options to pass to the form
     * @param array $data additional data to pass to the form
     *
     * @return \Dmandrade\FormBuilder\Form
     */
    protected function form($name, array $options = [], array $data = [])
    {
        return \App::make('form-builder')->create($name, $options, $data);
    }

    /**
     * Create a plain Form instance
     *
     * @param array $options Options to pass to the form
     * @param array $data additional data to pass to the form
     *
     * @return \Dmandrade\FormBuilder\Form
     */
    protected function plain(array $options = [], array $data = [])
    {
        return \App::make('form-builder')->plain($options, $data);
    }

    /**
     * @param $viewName
     * @param array $options
     * @param array $data
     * @param null $id
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function renderForm($viewName, $options = [], $data = [], $id=null)
    {
        $model = (!empty($id)) ? $this->model->findOrFail($id) : $this->model;
        /** @var \Dmandrade\FormBuilder\Form $form */
        $form = app(FormBuilder::class)->create($this->form, array_merge([
            'model' => $model
        ], $options), $data);

        $viewData = ['form' => $form];

        return view($viewName, $viewData);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function postForm(Request $request)
    {
        /** @var \Dmandrade\FormBuilder\Form $form */
        $form = app(FormBuilder::class)->create($this->form, [
            'model' => $this->model
        ]);


        if (!$form->isValid()) {
            return $form->validateAndRedirectBack();
        }

        $result = $this->beforeSave($form, $request);

        if ($result != null) {
            return $result;
        }

        $result = $this->save($this->dataToSave($request), $form, $request);

        if ($result != null) {
            return $result;
        }

        return $this->getRedirection();

    }

    /**
     * @param Request $request
     * @return array
     */
    protected function dataToSave(Request $request)
    {
        return $request->only($this->model->getFillable());
    }

    /**
     * @param Form $form
     * @param Request $request
     * @return null
     */
    protected function beforeSave(Form $form, Request $request)
    {
        return null;
    }

    /**
     * @param Form $form
     * @param Request $request
     * @return null
     */
    protected function afterSave(Form $form, Request $request)
    {
        return null;
    }

    /**
     * @param Form $form
     * @param Request $request
     * @return null
     */
    protected function afterUpdate(Form $form, Request $request)
    {
        return null;
    }

    public function setRedirectionTo($action, $parameters = [])
    {
        $this->redirectTo = action($this->getControllerNameForAction() . '@'.$action, $parameters);

        return $this;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function getRedirection(){

        if(empty($this->redirectTo)){
            return Redirect::back();
        }

        return Response::redirectTo($this->redirectTo);
    }

    /**
     * @param array $data
     * @param Form $form
     * @param Request $request
     * @return null
     */
    protected function save(array $data, Form $form, Request $request)
    {

        $primary = $request->get($this->model->getKeyName());
        if (empty($primary)) {
            $this->model = $this->model->create($data);
            return $this->afterSave($form, $request);
        }
        if (!$this->model->exists) {
            $this->model = $this->model->find($primary);
        }

        $this->model->update($data);

        return $this->afterUpdate($form, $request);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getView($id)
    {
        $model = (!empty($id)) ? $this->model->findOrFail($id) : $this->model;
        /** @var \Dmandrade\FormBuilder\Form $form */
        $form = app(FormBuilder::class)->create($this->form, [
            'model' => $model
        ]);

        $formContent = view('form-builder::form.layouts.info', [
            'form' => $form,
            'id' => $id,
            'route' => $this->getControllerNameForAction() . '@',
        ]);


        return view('form-builder::form.state.form', [
            'form' => $formContent
        ]);

    }

    /**
     * @return string
     */
    protected function getControllerNameForAction()
    {

        $action = explode('@', \Route::currentRouteAction());

        return '\\' . $action[0];
    }
}