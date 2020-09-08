<?php

namespace App\Repositories;

use DB;
use App\Enum\Status;
use App\Models\Folder;

class DataRepository
{
	protected $model;

	public function __construct(Folder $model)
	{
	    $this->model = $model;
    }

    public function dataTable()
    {
    	return $this->model->select('*');
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
        $model->nama_folder = $params['nama_folder'];
        $model->save();

        DB::commit();
        return true;
    }

    public function update($id, $params = [])
    {
        DB::beginTransaction();
        $model = $this->model->find($id);
        $model->nama_folder = $params['nama_folder'];
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