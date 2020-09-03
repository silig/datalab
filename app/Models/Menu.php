<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Menu extends Model
{
    use Cachable;
    
    protected $table = 'menus';

    public function childs() 
    {
        return $this->hasMany('App\Models\Menu','parent_id','id') ;
   	}

   	public function parent() 
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id', 'id');
    }

   	public function permissions()
    {
        return $this->hasMany('App\Models\Permission','menu_id','id');
    }
}
