<?php

namespace App\Repositories\DocumentRepository;


use App\Interfaces\documents\UnArchiveDocumentInterface;
use App\Models\Document;

class UnArchiveDocumentRepository implements UnArchiveDocumentInterface
{

    public function execute(int $document_id): string
    {
        $document = Document::onlyTrashed()->find($document_id);
        if ($document){
            $document->restore();
            return "Document désarchivé !";
        }
        return "Document non existant !";
    }
}
