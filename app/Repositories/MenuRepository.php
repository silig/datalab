<?php
namespace App\Repositories;

use DB;
use Auth;
use App\Models\Menu;

class MenuRepository
{

    protected $model;
      
    public function __construct(Menu $model) {
        $this->model = $model;
    }

    public function dataTable()
    {
        return $this->model->select('*');
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
        $model->url = !empty($request->input('url')) ? $request->input('url') : '#';
        $model->icon = $request->input('icon');
        $model->parent_id = !empty($request->input('parent_id')) ? $request->input('parent_id') : 0;
        $model->order = $request->input('order');
        $model->save();

        DB::commit();
        return true;
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        $model = $this->model->find($id);
        $model->name = $request->input('name');
        $model->url = !empty($request->input('url')) ? $request->input('url') : '#';
        $model->icon = $request->input('icon');
        $model->parent_id = !empty($request->input('parent_id')) ? $request->input('parent_id') : 0;
        $model->order = $request->input('order');
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

    public function getOptions() {
        $menus = $this->model->select('id','name','parent_id')->get();
        $options = $this->toOptions($this->treeView($menus));
        return $options;
    }

    public function getMenuPermission() {
        $menus = $this->model->with('permissions')
                    ->select('id','name','parent_id')->get()
                    ->toArray();

        $options = $this->treeView($menus);
        return $options;
    }

    protected function toOptions($trees) {
        $option = [];
        foreach ($trees as $tree) {
            $option[$tree['value']] = $tree['label'];
        }

        return $option;
    }

    protected function treeView($elements = [], $parentId = 0, $delimiter = '__') {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $branch[$element['id']] = [ 
                    'value' => $element['id'],
                    'label' => $element['name'],
                    'permissions' => $element['permissions'],
                ];

                $children = $this->treeView($elements, $element['id'], $delimiter);
                $del = $delimiter;
                if ($children) {
                    foreach ($children as $child) {
                        $branch[$child['value']] = [ 
                            'value' => $child['value'],
                            'label' => $del.$child['label'],
                            'permissions' => $child['permissions'],
                        ];
                    }
                }
            }
        }

        return $branch;
    }

    
}