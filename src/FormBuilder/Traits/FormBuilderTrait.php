<?php
namespace Dmandrade\FormBuilder\Traits;

use Dmandrade\FormBuilder\FormBuilder;
use Illuminate\Http\Request;

trait FormBuilderTrait
{

    /**
     * @var \Dmandrade\FormBuilder\Form $form
     * Injected by the constructor
     */
    protected $form;
    protected $model;


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
     * @param string $id
     * @param string $name Full class name of the form class
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function renderForm($viewName, $viewData=[], $id=null)
    {
        $model = (!empty($id)) ? $this->model->findOrFail($id) : $this->model;
        /** @var \Dmandrade\FormBuilder\Form $form */
        $form = app(FormBuilder::class)->create($this->form, [
            'model' => $model
        ]);

        $viewData = array_merge_recursive(['form' => $form], $viewData);

        return view($viewName, $viewData);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed|null
     */
    public function postForm(Request $request)
    {
        /** @var \Dmandrade\FormBuilder\Form $form */
        $form = app(FormBuilder::class)->create($this->form, [
            'model' => $this->model
        ]);


        if ($form->isValid()) {
            return $form->validateAndRedirectBack();
        }

        $result = $this->beforeSave();

        if ($result != null) {
            return $result;
        }

        $result = $this->save($this->dataToSave($request), $request);

        if ($result != null) {
            return $result;
        }

        return redirect()->to(action($this->getControllerNameForAction() . '@index'));

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
     * @return null
     */
    protected function beforeSave()
    {
        return null;
    }

    /**
     * @return null
     */
    protected function afterSave()
    {
        return null;
    }


    /**
     * @param $data
     * @param Request $request
     * @return null
     */
    protected function save($data, Request $request)
    {

        $primary = $request->get($this->model->getKeyName());
        if (empty($primary)) {
            $this->model = $this->model->create($data);
        } else {
            $this->model = $this->model->find($primary);
            $this->model->update($data);
        }

        return $this->afterSave();
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