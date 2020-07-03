<?php

namespace Kakhura\LaravelSiteBases\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Kakhura\LaravelSiteBases\Helpers\UploadHelper;
use Kakhura\LaravelSiteBases\Models\Base;

class Service
{
    /**
     * @param array $deletePathes
     * @return void
     */
    protected function deleteFiles(array $deletePathes)
    {
        File::delete($deletePathes);
    }

    /**
     * @param UploadedFile $file
     * @param string $uploadPath
     * @param array $deletePathes
     * @param Base $model
     * @return array
     */
    protected function uploadFile(UploadedFile $file = null, string $uploadPath = null, array $deletePathes = [], Base $model = null, bool $notUploaded = false): array
    {
        if ($notUploaded) {
            return [
                'fileName' => null,
                'thumbFileName' => null,
            ];
        }
        if (!is_null($file)) {
            $file = UploadHelper::uploadFile($file, $uploadPath);
            if (count($deletePathes) > 0) {
                $this->deleteFiles($deletePathes);
            }
        } else {
            $file = [
                'fileName' => $model->image ?? null,
                'thumbFileName' => $model->thumb ?? null,
            ];
        }
        return $file;
    }
}
