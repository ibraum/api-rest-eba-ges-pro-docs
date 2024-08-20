<?php

namespace App\Repositories\DocumentRepository;



use App\Http\Requests\documentRequest\UpdateDocumentRequest;
use App\Interfaces\documents\UpdateDocumentInterface;
use App\Models\Document;

class UpdateDocumentRepository implements UpdateDocumentInterface
{
    public function execute(UpdateDocumentRequest $request,string $path, int $document_id): Document
    {
            $document = Document::all()->find($document_id);
            $document->name = $request->input('name') ?? $document->name;
            $document->path = $path ?? $document->path;
            $document->date_created = $request->input('date_created') ?? $document->date_created;
            $document->author = $request->input('author') ?? $document->author;
            $document->last_update = now()->format('Y-m-d H:i:s');
            $document->last_user = auth()->id ?? 1;
            $document->save();
            return $document;
    }
}
