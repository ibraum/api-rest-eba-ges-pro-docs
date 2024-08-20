<?php

namespace App\Repositories\HistoryRepository;

use App\Interfaces\histories\GetDocumentHistoryInterface;
use App\Models\History;
use Illuminate\Database\Eloquent\Collection;

class GetDocumentHistoryRepository implements GetDocumentHistoryInterface
{

    public function execute(int $document_id): Collection
    {
        return History::all()->where('document_id', $document_id);
    }
}
