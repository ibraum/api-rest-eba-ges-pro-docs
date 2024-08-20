<?php

namespace App\Repositories\DocumentRepository;


use App\Interfaces\documents\ListArchiveDocumentInterface;
use App\Models\Document;
use Illuminate\Database\Eloquent\Collection;

class ListArchiveDocumentRepository implements ListArchiveDocumentInterface
{

    public function execute(): Collection
    {
        return Document::onlyTrashed()->get();
    }
}
