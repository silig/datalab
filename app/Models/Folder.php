<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folder';

    protected $fillable = [
        'nama_folder'
    ];

    public function data()
    {
    	return $this->hasMany('App\Models\Data');
    }
}
