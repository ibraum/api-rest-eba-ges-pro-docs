<?php

namespace App\Interfaces\documents;


use App\Http\Requests\documentRequest\DocumentRequest;
use App\Models\Document;

interface CreateDocumentInterface
{
    public function execute(DocumentRequest $request, string $path) : Document;
}
