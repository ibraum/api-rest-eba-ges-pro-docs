<?php

namespace App\Repositories\DocumentRepository;


use App\Interfaces\documents\SaveFileDocumentInterface;
use Illuminate\Http\UploadedFile;

class SaveFileDocumentRepository implements SaveFileDocumentInterface
{
    public function execute(UploadedFile $path): string
    {
        return $path->store('documents', 'public');
    }
}
