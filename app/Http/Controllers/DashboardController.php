<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Folder;
use App\Models\Data;

class DashboardController extends Controller
{
    public function index(){
    	$folder = Folder::orderBy('id', 'asc')->get();

    	return view('home.dashboard', compact('folder'));

    }

    public function files($id){


    	$files = Data::where('folder_id', $id)->get();
    	$folder = Folder::find($id);

    	if($folder){
    		return view('home.isi', compact('files', 'folder'));
    	}else{
    		 return redirect()->back()->with('salah', 'Ora enek datane boss!!!');
    	}
    }
}
