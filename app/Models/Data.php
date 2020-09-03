<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';

    protected $fillable = [
        'nama_data', 'file'
    ];

    public function data()
    {
    	return $this->belongsTo('App\Models\Folder');
    }
}
