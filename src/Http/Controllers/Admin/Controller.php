<?php

namespace Kakhura\LaravelSiteBases\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Kakhura\LaravelSiteBases\Helpers\FileSecurity;
use Kakhura\LaravelSiteBases\Helpers\UploadHelper;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return void
     */
    public function index()
    {
        return view('vendor.site-bases.admin.index');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function uploadFromRedactor(Request $request)
    {
        if ($request->hasFile('file')) {
            $this->validate($request, [
                'file' => 'required|file|image|mimes:' . implode(',', FileSecurity::allowedImageExtensions()) . '|max:20480',
            ]);
            config(['kakhura.site-bases.images_thumbs.generate_thumb_for_images' => false]);
            $image = UploadHelper::uploadFile($request->file('file'), '/upload/redactor/');
            $file = [
                'filelink' => asset(Arr::get($image, 'fileName')),
            ];
            return response()->json($file);
        }
    }

    /**
     * @param Request $request
     * @return void
     */
    public function ordering(Request $request)
    {
        $className = $this->resolveModelClass($request->get('className'));
        foreach ((array) json_decode($request->ordering, true) as $value) {
            $object = $className::find(Arr::get($value, 0));
            if ($object) {
                $object->update([
                    'ordering' => Arr::get($value, 1, 0),
                ]);
            }
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function publish(Request $request): JsonResponse
    {
        $className = $this->resolveModelClass($request->get('className'));
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

    /**
     * Only Eloquent models may be targeted by className, so the request
     * cannot call static methods on arbitrary classes.
     *
     * @param mixed $className
     * @return string
     */
    protected function resolveModelClass($className): string
    {
        $className = ltrim((string) $className, '\\');
        if ($className === '' || !class_exists($className) || !is_subclass_of($className, Model::class)) {
            abort(400, 'Invalid className.');
        }
        return $className;
    }
}
