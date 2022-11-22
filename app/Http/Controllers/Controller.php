<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function UploadFile($data, $model){
        
        $file = $data['file'];
        $path = $data['path_to_save'];

        $file_name      = $file->hashName();
        $full_path_url  = $file->storeAs($path, $file_name, 'public_path');

        return $model->asset()->create([
            'name'          => $file_name ,
            'old_name'      => $file->getClientOriginalName(),
            'size'          => $file->getSize(),
            'url'           => $full_path_url,
            'mime_type'     => $file->getMimeType()
        ]);
    }

}
