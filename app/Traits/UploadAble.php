<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use File;

/**
 * Trait UploadAble
 * @package App\Traits
 */
trait UploadAble
{
    /**
     * @param UploadedFile $file
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */
    public function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(25);

        return $file->storeAs(
            $folder,
            $name . "." . $file->getClientOriginalExtension(),
            $disk
        );
    }

    /**
     * @param null $path
     * @param string $disk
     */
    public function deleteOne($path = null, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }

    public function UploadFile(UploadedFile $file, $folder)
    {
        $NamaFile = preg_replace('/\s+/', '_', time(). ' '. $folder . ' ' .$file->getClientOriginalName());
        $path = Storage_path('App/public/Data/'.$folder);

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        //Image::make($file)->resize(250, 300)->save($path . '/' . $NamaFile);
        $file->storeas('public/Data/'.$folder ,$NamaFile);
        
        
        return $NamaFile;
    }
}
