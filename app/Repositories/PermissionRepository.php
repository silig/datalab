<?php
namespace App\Repositories;

use DB;
use App\Models\Permission;

class PermissionRepository
{

    protected $model;
      
    public function __construct(Permission $model) {
        $this->model = $model;
    }

    public function dataTable()
    {
        return $this->model->with('menu')->select('permissions.*');
    }

    public function find($id)
    {
        $model = $this->model->findOrFail($id);
        return $model;
    }
     
    public function create($request)
    {
        DB::beginTransaction();
        
        $model = $this->model;
        $model->name = $request->input('name');
        $model->alias = $request->input('alias');
        $model->menu_id = !empty($request->input('menu_id')) ? $request->input('menu_id') : 0;
        $model->save();
        
        DB::commit();
        return true;
    }

    public function update($id, $request)
    {
        DB::beginTransaction();

        $model = $this->model->find($id);
        $model->name = $request->input('name');
        $model->alias = $request->input('alias');
        $model->menu_id = !empty($request->input('menu_id')) ? $request->input('menu_id') : 0;
        $model->save();
        
        DB::commit();
        return true;
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $model = $this->model->find($id);
        $model->delete();
        DB::commit();
        return true;
    }
}