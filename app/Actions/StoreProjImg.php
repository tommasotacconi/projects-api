<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;

class StoreProjImg
{
    public function __construct(
        protected string $disk = 'public',
        protected string $folder = 'images/projects',
    ) {
    }

    public function handle(UploadedFile $file): string
    {
        return $file->store($this->folder, $this->disk);
    }
}