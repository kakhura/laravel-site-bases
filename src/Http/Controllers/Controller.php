<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Kakhura\LaravelSiteBases\Helpers\UploadHelper;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
