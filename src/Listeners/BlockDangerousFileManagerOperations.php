<?php

namespace Kakhura\LaravelSiteBases\Listeners;

use Kakhura\LaravelSiteBases\Helpers\FileSecurity;

/**
 * unisharp/laravel-filemanager only blocks extensions starting with "php" on
 * upload, and does not check extensions at all on rename or move. That allows
 * uploading shell.phar / .htaccess, or uploading x.jpg and renaming it to x.php.
 * This listener rejects any such operation before the file is written.
 */
class BlockDangerousFileManagerOperations
{
    public function handle($event): void
    {
        $path = method_exists($event, 'newPath') ? $event->newPath() : (method_exists($event, 'path') ? $event->path() : null);

        if (is_null($path) || FileSecurity::isDangerousFileName($path)) {
            abort(403, 'This file name or type is not allowed.');
        }
    }
}
