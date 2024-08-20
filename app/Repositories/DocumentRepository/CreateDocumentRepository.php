<?php

namespace App\Repositories\DocumentRepository;



use App\Http\Requests\documentRequest\DocumentRequest;
use App\Interfaces\documents\CreateDocumentInterface;
use App\Models\Document;

class CreateDocumentRepository implements CreateDocumentInterface
{
public function execute(DocumentRequest $request, string $path): Document
   {
       $document = new Document();
       $document->name = $request->input('name');
       $document->path = $path;
       $document->date_created = $request->input('date_created');
       $document->author = $request->input('author');
       $document->project_id = $request->input('project_id');
       $document->save();
       return $document;
   }
}
