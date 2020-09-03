<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Permission extends Model
{
	use Cachable;
	
    protected $table = 'permissions';

    public function menu() 
    {
        return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
    }
}
