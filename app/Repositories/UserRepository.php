<?php

namespace App\Repositories;

use DB;
use App\Enum\Status;
use App\Models\User;

class UserRepository
{
	protected $model;

	public function __construct(User $model)
	{
	    $this->model = $model;
    }

    public function dataTable()
    {
    	return $this->model->with('role')->select('users.*');
    }
    
	public function find($id)
	{
		return $this->model->with('role')->findOrFail($id);
	}

	public function findBy($column, $data)
	{
		return $this->model->where($column, $data)->get();
	}

	public function create($params = [])
    {
        DB::beginTransaction();

        $model = $this->model;
        $model->username = $params['username'];
        // $model->email = $params['email'];
        // $model->phone = $params['phone'];
        $model->password = bcrypt($params['password']);
        $model->role_id = $params['role_id'];
        $model->active = !empty($params['active']) ? $params['active'] : Status::INACTIVE;
        $model->save();

        DB::commit();
        return true;
    }

    public function update($id, $params = [])
    {
        DB::beginTransaction();
        $model = $this->model->find($id);
        $model->username = $params['username'];
        // $model->email = $params['email'];
        // $model->phone = $params['phone'];
        if (!empty($params['password'])) {
           $model->password = bcrypt($params['password']);
        }
        $model->role_id = $params['role_id'];
        $model->active = !empty($params['active']) ? $params['active'] : Status::INACTIVE;
        $model->save();

        DB::commit();
        return true;
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    public function changePassword($id, $password)
    {
        DB::beginTransaction();
        $model = $this->model->find($id);
        $model->password = bcrypt($password);
        $model->save();
        DB::commit();
        return true;
    }
}