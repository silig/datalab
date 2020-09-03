<?php
namespace App\Http\Controllers\Admin;

use JsValidator;
use Validator;
use DataTables;
use Illuminate\Http\Request;
use App\Repositories\MenuRepository;
use App\Repositories\PermissionRepository;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller {
    
    protected $model;
    protected $menu;

    public function __construct(
        PermissionRepository $permission,
        MenuRepository $menu
    ) {
        $this->model = $permission;
        $this->menu = $menu;
    }
    
    protected function validationRules($id = 0) {
        $rule['name'] = 'required|unique:permissions'. ($id ? ",id,$id" : '');
        $rule['alias'] = 'required';
        return $rule;
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            return DataTables::of($this->model->dataTable())->toJson();
        }

        return view('permissions.list');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), $this->validationRules());
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                $this->model->create($request);
                return redirect()->action('Admin\PermissionsController@index')
                                        ->with('success', 'Data has been saved');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $options = $this->menu->getOptions();
        $validator = JsValidator::make($this->validationRules());

        return view('permissions.form', compact('options','validator'));
    }

    public function edit($id, Request $request)
    {
        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), $this->validationRules($id));
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                $this->model->update($id, $request);
                return redirect()->action('Admin\PermissionsController@index')
                                            ->with('success', 'Data has been updated');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $options = $this->menu->getOptions();
        $validator = JsValidator::make($this->validationRules($id));
        $model = $this->model->find($id);

        return view('permissions.form', compact('options','model','validator'));
    }

    public function view($id)
    {
        $model = $this->model->find($id);
        return view('permissions.view', compact('model'));
    }

    public function delete($id) 
    {
       try {
            $this->model->destroy($id);
            return redirect()->action('Admin\PermissionsController@index')
                                    ->with('success', 'Data has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
}

