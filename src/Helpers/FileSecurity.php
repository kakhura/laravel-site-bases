<?php

namespace Kakhura\LaravelSiteBases\Helpers;

use Illuminate\Support\Str;

class FileSecurity
{
    /**
     * Extensions that a web server may execute or treat as configuration.
     * These are never allowed, regardless of any configured allow list.
     */
    public const FORBIDDEN_EXTENSIONS = [
        'php', 'php2', 'php3', 'php4', 'php5', 'php6', 'php7', 'php8', 'phtml', 'pht', 'phps', 'phar', 'pgif', 'inc',
        'htaccess', 'htpasswd', 'ini',
        'html', 'htm', 'xhtml', 'shtml', 'xht', 'svg', 'svgz', 'xml', 'js', 'mjs',
        'cgi', 'pl', 'py', 'rb', 'sh', 'bash', 'asp', 'aspx', 'jsp', 'jspx', 'exe', 'com', 'bat', 'dll', 'so',
    ];

    /**
     * MIME types (detected from file content) that are never accepted.
     */
    public const FORBIDDEN_MIME_TYPES = [
        'text/x-php',
        'application/x-php',
        'application/x-httpd-php',
        'application/x-httpd-php-source',
        'text/html',
        'application/xhtml+xml',
        'image/svg+xml',
        'text/javascript',
        'application/javascript',
        'text/x-shellscript',
        'application/x-sh',
    ];

    public const DEFAULT_IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    public const DEFAULT_FILE_EXTENSIONS = [
        'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'odt', 'ods', 'rtf', 'txt', 'csv',
        'zip', 'rar', '7z',
        'jpg', 'jpeg', 'png', 'gif', 'webp',
        'mp3', 'mp4', 'webm', 'mov',
    ];

    public static function isForbiddenExtension(?string $extension): bool
    {
        $extension = Str::lower(trim((string) $extension, " .\t\n\r\0\x0B"));
        return in_array($extension, self::FORBIDDEN_EXTENSIONS, true);
    }

    public static function isForbiddenMimeType(?string $mimeType): bool
    {
        return in_array(Str::lower((string) $mimeType), self::FORBIDDEN_MIME_TYPES, true);
    }

    /**
     * Checks a file name (not a path) for anything a web server could execute:
     * dot files (.htaccess, .user.ini), and any forbidden extension anywhere in
     * the name (shell.php.jpg, shell.phar, shell.php.).
     */
    public static function isDangerousFileName(?string $fileName): bool
    {
        $fileName = trim(basename(str_replace('\\', '/', (string) $fileName)));
        if ($fileName === '' || Str::startsWith($fileName, '.')) {
            return true;
        }
        $parts = explode('.', Str::lower(rtrim($fileName, ". \t")));
        array_shift($parts);
        foreach ($parts as $part) {
            if (self::isForbiddenExtension($part)) {
                return true;
            }
        }
        return false;
    }

    public static function allowedImageExtensions(): array
    {
        return self::cleanAllowList(config('kakhura.site-bases.upload_allowed_image_extensions', self::DEFAULT_IMAGE_EXTENSIONS));
    }

    public static function allowedFileExtensions(): array
    {
        return self::cleanAllowList(config('kakhura.site-bases.upload_allowed_file_extensions', self::DEFAULT_FILE_EXTENSIONS));
    }

    /**
     * A configured allow list can never re-enable a forbidden extension.
     */
    protected static function cleanAllowList($extensions): array
    {
        $extensions = array_map(fn ($extension) => Str::lower(trim((string) $extension, " .")), (array) $extensions);
        return array_values(array_filter($extensions, fn ($extension) => $extension !== '' && !self::isForbiddenExtension($extension)));
    }
}
