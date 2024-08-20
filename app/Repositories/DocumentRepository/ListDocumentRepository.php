<?php

namespace App\Repositories\DocumentRepository;


use App\Interfaces\documents\ListDocumentInterface;
use App\Models\Document;
use Illuminate\Database\Eloquent\Collection;

class ListDocumentRepository implements ListDocumentInterface
{

    public function execute(): Collection
    {
        return Document::all();
    }
}
