<?php

namespace App\Repositories\DocumentRepository;


use App\Interfaces\documents\DeleteDocumentInterface;
use App\Models\Document;

class DeleteDocumentRepository implements DeleteDocumentInterface
{
    public function execute(int $document_id): string
    {
        $document = Document::all()->find($document_id);
        if($document)
        {
            $document->forceDelete();
            return "Suppression effectué avec succès !";
        }
        return "Le document que vous essayez de supprimer n'existe pas dans la base !";
    }
}
