<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\DataRepository;
use App\Http\Controllers\Controller;
use DataTables;
use Validator;
use JsValidator;
use App\Models\Folder;
use App\Models\Data;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use File;

class DataController extends Controller
{
    protected $model;
    use UploadAble;


    public function __construct(
        DataRepository $data
    ) {
        $this->model = $data;
    }

    protected function validationRules($scope = 'create', $id = 0) {
        //unique:users'. ($id ? ",id,$id" : '');
        $rule['nama_folder'] = 'required|unique:folder'. ($id ? ",id,$id" : '');
        return $rule;
    }

    protected function pesan(){
        $pesan['nama_folder.required'] = 'Nama Folder Tidak Boleh Kosong';

        return $pesan;
    }
 
    public function index(Request $request){
        $menus = Folder::orderBy('id')->get();
        $validator = JsValidator::make($this->validationRules(), $this->pesan());

        return view('data.list', compact('menus', 'validator'));
    }

    public function create(Request $request)
    {
        

            $validation = Validator::make($request->all(), $this->validationRules(), $this->pesan());
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                $this->model->create($request->all());
                return redirect()->action('Admin\DataController@index')->with('success', 'Data has been saved');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        
    }

    public function edit($id, Request $request)
    {
       

            $validation = Validator::make($request->all(), $this->validationRules('edit', $id));
            if ($validation->fails()) {
                return redirect()->back()->withInput()->withErrors($validation->errors());
            }

            try {
                          
                $this->model->update($id, $request->all());
                return redirect()->action('Admin\DataController@index')->with('success', 'Data has been updated');
            
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }
        
        
    }

    public function delete($id) 
    {   
        
        try {
            
          
                $this->model->destroy($id);
                return redirect()->action('Admin\DataController@index')->with('success', 'Data has been deleted');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function files($id){

        try {
                $file = Data::where('folder_id', $id)->get();
                $folder = Folder::find($id);

                if($folder){
                    return view('files.list', compact('file', 'folder'));
                }else{
                    return redirect()->back()->with('salah', 'Ora enek datane boss!!!');
                }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }

    }

    public function createFiles(Request $request){
        //dd($request->all());
        $folder = Folder::find($request->id_folder);
        if($folder == false){
            return redirect()->back()->withInput()->withErrors('maaf sepertinya terjadi kesalahan');
        } else {
            try{
                $files = new Data;
                $Upload = $this->UploadFile($request->file, $folder->nama_folder);
                $files->nama_data = $request->nama_file;
                $files->file = $Upload;
                $files->folder_id = $request->id_folder;
                $files->save();

                return redirect()->back()->with('success', 'Data has been updated');

            } catch (\Exception $e){
                return redirect()->back()->withInput()->withErrors($e->getMessage());
            }    

        }
    }

    public function deleteFiles($folder, $id) 
    {   
        $folder = Folder::find($folder);
        try {   
                $files = Data::find($id);
                $this->deleteOne('Data/'.$folder->nama_folder.'/'.$files->file);
                $files->destroy($id);
                return redirect()->back()->with('success', 'Data has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
}
