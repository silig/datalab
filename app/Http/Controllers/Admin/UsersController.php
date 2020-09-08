<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Http\Controllers\Controller;
use DataTables;
use Validator;
use JsValidator;

class UsersController extends Controller
{
	protected $model;
    protected $role;

    public function __construct(
        UserRepository $user, 
        RoleRepository $role
    ) {
        $this->model = $user;
        $this->role = $role;
    }

    protected function validationRules($scope = 'create', $id = 0) {
        $rule['username'] = 'required|unique:users'. ($id ? ",id,$id" : '');
        $rule['role_id'] = 'required';
        // $rule['phone'] = 'required';
        // $rule['email'] = 'required|email|unique:users'. ($id ? ",id,$id" : '');
        if ($scope == 'create') {
            $rule['password'] = 'required';
        }
        return $rule;
    }

    protected function pesan(){
        $pesan['username.required'] = 'Nama tidak boleh kosong';
        $pesan['username.unique'] = 'Nama sudah ada';

        return $pesan;
    }
 
    public function index(Request $request){
    	if ($request->ajax()){
            
            return DataTables::of($this->model->dataTable())->toJson();
        }

        return view('users.list');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), $this->validationRules(),$this->pesan());
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                $this->model->create($request->all());
                return redirect()->action('Admin\UsersController@index')->with('success', 'Data has been saved');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $roles = $this->role->getOptions();
        $validator = JsValidator::make($this->validationRules());

        return view('users.form', compact('roles','validator'));
    }

    public function edit($id, Request $request)
    {
        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), $this->validationRules('edit', $id),$this->pesan());
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                if($id==1){
                return redirect()->action('Admin\UsersController@index')->with('danger', 'Sorry boss SuperAdmin tidak dapat diubah');
            } 
            else {
                $this->model->update($id, $request->all());
                return redirect()->action('Admin\UsersController@index')->with('success', 'Data has been updated');
            }
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        }

        $roles = $this->role->getOptions();
        $validator = JsValidator::make($this->validationRules('edit', $id));
        $model = $this->model->find($id);

        return view('users.form', compact('model','roles','validator'));
    }

    public function delete($id) 
    {   
        
        try {
            if($id==1){
                return redirect()->action('Admin\UsersController@index')->with('danger', 'Sorry boss SuperAdmin tidak dapat dihapus');
            } 
            else {
                $this->model->destroy($id);
                return redirect()->action('Admin\UsersController@index')->with('success', 'Data has been deleted');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
}
