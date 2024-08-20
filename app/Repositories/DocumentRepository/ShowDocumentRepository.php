<?php

namespace App\Repositories\DocumentRepository;


use App\Interfaces\documents\ShowDocumentInterface;
use App\Models\Document;

class ShowDocumentRepository implements ShowDocumentInterface
{

    public function execute(int $document_id): Document
    {
        $document = Document::all()->find($document_id);
        if($document)
        {
            return $document;
        }
        return new Document();
    }
}
