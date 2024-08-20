<?php

namespace App\Interfaces\documents;


use App\Http\Requests\documentRequest\UpdateDocumentRequest;
use App\Models\Document;

interface UpdateDocumentInterface
{
    public function execute(UpdateDocumentRequest $request, string $path, int $document_id) : Document;
}
