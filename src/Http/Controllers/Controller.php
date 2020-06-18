<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers;

use App\Helpers\File\UploadHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function uploadFromRedactor(Request $request)
    {
        if ($request->hasFile('file')) {
            config(['kakhura.site-bases.images_thumbs.generate_thumb_for_images' => false]);
            $imageName = UploadHelper::uploadFile($request->file, '/upload/redactor/');
            $file = [
                'filelink' => asset($imageName),
            ];
            return response()->json($file);
            // echo stripslashes(json_encode());
        }
    }
}
