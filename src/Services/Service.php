<?php

namespace Kakhura\LaravelSiteBases\Services;

use App\Helpers\File\UploadHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Kakhura\LaravelSiteBases\Models\Base;

class Service
{
    protected function uploadFile(UploadedFile $file = null, array $deletePathes = [], string $uploadPath = null, Base $model = null)
    {
        if (!is_null($file)) {
            $file = UploadHelper::uploadFile($file, $uploadPath);
        } else {
            $file = [
                'fileName' => $model->image,
                'thumbFileName' => $model->thumb,
            ];
            if (count($deletePathes) > 0) {
                File::delete($deletePathes);
            }
        }
        return $file;
    }
}
