<?php

namespace App\Repositories\DocumentRepository;


use App\Interfaces\documents\ArchiveDocumentInterface;
use App\Models\Document;

class ArchiveDocumentRepository implements ArchiveDocumentInterface
{

    public function execute(int $document_id): string
    {
        $document = Document::all()->find($document_id);
        if ($document){
            $document->delete();
            return "Document archivé !";
        }
        return "Document non existant !";
    }
}
