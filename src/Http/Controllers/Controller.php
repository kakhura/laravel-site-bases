<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;
use Kakhura\LaravelSiteBases\Helpers\UploadHelper;

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

    /**
     * @param Request $request
     * @return void
     */
    public function ordering(Request $request)
    {
        $className = $request->get('className');
        foreach (json_decode($request->ordering) as $value) {
            $object = $className::find(Arr::get($value, 0));
            $object->update([
                'ordering' => $value[1],
            ]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function publish(Request $request): JsonResponse
    {
        $className = $request->get('className');
        $status = array('status' => 'error');
        $object = $className::findOrFail($request->id);
        $update = $object->update([
            'published' => $request->published,
        ]);
        if ($update) {
            $status['status'] = 'success';
        }
        return response()->json($status);
    }
}
