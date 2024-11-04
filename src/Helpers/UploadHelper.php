<?php

namespace Kakhura\LaravelSiteBases\Helpers;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UploadHelper
{
    /**
     * @param UploadedFile $file
     * @param string $folder
     * @param bool $isImage
     * @return array
     * @throws Exception
     */
    public static function uploadFile(UploadedFile $getFile, string $folder, bool $isImage = true): array
    {
        $folder = self::getFileTypeFolder($folder);
        $extension = Str::lower($getFile->getClientOriginalExtension());
        $fileUniqName = Str::random();
        $fileName = sprintf('%s%s%s.%s', trim($folder, '/\\'), DIRECTORY_SEPARATOR, $fileUniqName, $extension);
        if ($isImage) {
            return self::uploadImage($getFile, $fileName, $folder, $fileUniqName, $extension);
        } else {
            file_put_contents($fileName, file_get_contents($getFile));
            return [
                'fileName' => $fileName,
            ];
        }
    }

    /**
     * @param UploadedFile $getFile
     * @param string $fileName
     * @param string $folder
     * @param string $fileUniqName
     * @param string $extension
     * @return array
     */
    protected static function uploadImage(UploadedFile $getFile, string $fileName, string $folder, string $fileUniqName, string $extension): array
    {
        $manager = new ImageManager(new Driver());
        $file = $manager->read($getFile);
        if (config('kakhura.site-bases.images_watermark.add_watermark_to_images') && File::exists(public_path(config('kakhura.site-bases.images_watermark.watermark_path')))) {
            $file->place(public_path(config('kakhura.site-bases.images_watermark.watermark_path'), config('kakhura.site-bases.images_watermark.watermark_position'), config('kakhura.site-bases.images_watermark.watermark_x'), config('kakhura.site-bases.images_watermark.watermark_y')));
        }
        if (!is_null(config('kakhura.site-bases.max_image_width')) && $file->width() > config('kakhura.site-bases.max_image_width')) {
            $file->scale(config('kakhura.site-bases.max_image_width'));
        }
        $file->save(public_path($fileName));
        if (config('kakhura.site-bases.images_thumbs.generate_thumb_for_images')) {
            $thumbFileName = self::generateThumb($getFile, $folder, $fileUniqName, $extension, $manager);
        }
        return [
            'fileName' => $fileName,
            'thumbFileName' => $thumbFileName ?? null,
        ];
    }

    /**
     * @param UploadedFile $getFile
     * @param string $folder
     * @param string $fileUniqName
     * @param string $extension
     * @return string
     */
    protected static function generateThumb(UploadedFile $getFile, string $folder, string $fileUniqName, string $extension, ImageManager $manager): string
    {
        $file = $manager->read($getFile);
        $fileName = sprintf('%s%s%s.%s', trim($folder, '/\\'), DIRECTORY_SEPARATOR, $fileUniqName . '_thumb', $extension);
        $file->scale(config('kakhura.site-bases.images_thumbs.thumb_width'));
        $file->save(public_path($fileName));
        return $fileName;
    }

    /**
     * @return string
     */
    public static function getFileTypeFolder(string $folder): string
    {
        if (!File::exists(public_path($folder))) {
            File::makeDirectory(public_path($folder), 0755, true);
        }
        return $folder;
    }
}
