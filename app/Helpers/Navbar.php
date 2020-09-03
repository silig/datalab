<?php

namespace App\Helpers;

use Auth;
use App\Models\Menu;

class Navbar {

	public function getSideSetting() {
		$menuIds = collect(explode('-',$this->getMenuIds()))->unique();

        $arrayMenu = Menu::select('id','name','url','icon','parent_id')->where('id','<', 6);
        
        if (!Auth::user()->isSuperadmin()) {
       		$arrayMenu = $arrayMenu->whereIn('id', $menuIds);
       	}
        
        $arrayMenu = $arrayMenu->get()->toArray();

        return $this->buildTree($arrayMenu);
    }

    public function getSidemenu() {
        $menuIds = collect(explode('-',$this->getMenuIds()))->unique();

        $arrayMenu = Menu::select('id','name','url','icon','parent_id')->where('id','>=', 6);
        
        if (!Auth::user()->isSuperadmin()) {
            $arrayMenu = $arrayMenu->whereIn('id', $menuIds);
        }
        
        $arrayMenu = $arrayMenu->get()->toArray();

        return $this->buildTree($arrayMenu);
    }

    protected function getMenuIds() {
    	$arr = '';
    	$permissions = Auth::user()->role->permissions;

    	foreach ($permissions as $key => $permission) {
            $del = ($key != 0) ? '-' : '';
    		$arr .= $del . $permission->menu_id;
    		if ($permission->menu->parent) {
    			$arr .= '-' . $this->getParent($permission->menu->parent);
    		}
    	}
    	
    	return $arr;
    }

    protected function getParent($row) {
        $arr = $row->id;

        if ($row->parent) {
            $arr .= '-' . $this->getParent($row->parent);
        }
        
        return $arr;
    }

    protected function buildTree($elements, $parentId = 0) {
        $branch = [];

	    foreach ($elements as $key => $element) {
	        if ($element['parent_id'] == $parentId) {

	            $branch[$key]['id'] = $element['id'];
	            $branch[$key]['text'] = $element['name'];
	            $branch[$key]['url'] = config('adminlte.dashboard_url').$element['url'];
	            $branch[$key]['active'] = [$branch[$key]['url'], $branch[$key]['url'].'/*'];

	            if ($element['icon']) {
	            	$branch[$key]['icon'] = $element['icon'];
	            }

		    	$children = $this->buildTree($elements, $element['id']);
		    	if ($children) {
		    		$branch[$key]['submenu'] = $children;
		    	}
	        }
	    }

	    return $branch;
    }
}