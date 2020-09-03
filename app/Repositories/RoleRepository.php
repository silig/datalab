<?php
namespace App\Repositories;

use DB;
use App\Models\Role;

class RoleRepository
{

      protected $model;
      
      public function __construct(Role $model) {
         $this->model = $model;
      }

      public function dataTable()
      {
         return $this->model->select('*');
      }

      public function find($id)
      {
         $model = $this->model->with('permissions')->findOrFail($id);
         return $model;
      }

      protected function mappingArray($permissions, $roleId)
      {
         $data = [];
         if ($permissions) {
            foreach ($permissions as $permission) {
               $data[] = [
                   'role_id' => $roleId,
                   'permission_id' => $permission,
               ];
            }
         }

         return $data;
      }
     
      public function create($request)
      {
         DB::beginTransaction();
         $model = $this->model;
         $model->name = $request->input('name');
         $model->save();

         $data = $this->mappingArray($request->input('permissions'), $model->id);
         if (count($data) > 0) {
            DB::table('role_permission')->insert($data);
         }

         DB::commit();
         return true;
      }

      public function update($id, $request)
      {
         DB::beginTransaction();
         $model = $this->model->find($id);
         $model->name = $request->input('name');
         $model->save();

         $data = $this->mappingArray($request->input('permissions'), $id);
         DB::table('role_permission')->where('role_id', '=', $id)->delete();
         DB::table('role_permission')->insert($data);

         DB::commit();
         return true;
      }

      public function destroy($id)
      {
         DB::beginTransaction();
         $model = $this->model->find($id);
         DB::table('role_permission')->where('role_id', '=', $id)->delete();
         $model->delete();
         DB::commit();
         return true;
      }

      public function getOptions() 
      {
         $roles = $this->model->select('id','name')->get();
         $options = [];
         
         foreach($roles as $role) {
            $options[$role->id] = $role->name;
         }

         return $options;
      }
      
}