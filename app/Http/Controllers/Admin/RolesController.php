<?php

namespace App\Http\Controllers\Admin;

use JsValidator;
use Validator;
use DataTables;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use App\Repositories\MenuRepository;
use App\Http\Controllers\Controller;

class RolesController extends Controller {
    
    protected $model;
    protected $menu;

    public function __construct(
        RoleRepository $role,
        MenuRepository $menu
    ) {
        $this->model = $role;
        $this->menu = $menu;
    }
    
    protected function validationRules() {
        $rule['name'] = 'required';
        return $rule;
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            return DataTables::of($this->model->dataTable())->toJson();
        }

        return view('roles.list');
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
                return redirect()->action('Admin\RolesController@index')->with('success', 'Data has been saved');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $menus = $this->menu->getMenuPermission();
        $validator = JsValidator::make($this->validationRules());

        return view('roles.form', compact('menus','validator'));
    }

    public function edit($id, Request $request)
    {
        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), $this->validationRules());
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                $data = $this->model->update($id, $request);
                return redirect()->action('Admin\RolesController@index')->with('success', 'Data has been saved');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $menus = $this->menu->getMenuPermission();
        $validator = JsValidator::make($this->validationRules('edit'));
        $model = $this->model->find($id);
        
        return view('roles.form', compact('menus','model','validator'));
    }

    public function view($id)
    {
        $model = $this->model->find($id);
        return view('roles.view', compact('model'));
    }

    public function delete($id) 
    {
        try {
            $this->model->destroy($id);
            return redirect()->action('Admin\RolesController@index')->with('success', 'Data has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
}

