<?php

namespace Kakhura\LaravelSiteBases\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Kakhura\LaravelSiteBases\Helpers\UploadHelper;
use Kakhura\LaravelSiteBases\Models\Base;

class Service
{
    protected function uploadFile(UploadedFile $file = null, string $uploadPath = null, array $deletePathes = [], Base $model = null)
    {
        if (!is_null($file)) {
            $file = UploadHelper::uploadFile($file, $uploadPath);
            if (count($deletePathes) > 0) {
                File::delete($deletePathes);
            }
        } else {
            $file = [
                'fileName' => $model->image,
                'thumbFileName' => $model->thumb,
            ];
        }
        return $file;
    }
}
