<?php

namespace App\Interfaces\documents;


use Illuminate\Http\UploadedFile;

interface SaveFileDocumentInterface
{
    public function execute(UploadedFile $path) : string;
}
