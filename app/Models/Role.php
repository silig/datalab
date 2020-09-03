<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Role extends Model
{
    protected $table = 'roles';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'role_permission','role_id','permission_id');
    }
}
