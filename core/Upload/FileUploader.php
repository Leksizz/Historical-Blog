<?php

namespace App\Core\Upload;

class FileUploader implements FileUploaderInterface
{

    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $tmpName,
        public readonly int    $error,
        public readonly int    $size,
    )
    {
    }

    public function move(string $path): string|false
    {
        $storage = APP_PATH . "/storage/$path";

        if (!is_dir($storage)) {
            mkdir($storage, 0777, true);
        }

        $fileName = $this->generateFileName();

        $filePath = "$storage/$fileName";

        if (move_uploaded_file($this->tmpName, $filePath)) {
            return "storage/$path/$fileName";
        }
        return false;
    }

    private function generateFileName(): string
    {
        $name = microtime();
        return "$name." . $this->extension();
        // подумать над доступам к файлам
    }

    private function extension(): string
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

}