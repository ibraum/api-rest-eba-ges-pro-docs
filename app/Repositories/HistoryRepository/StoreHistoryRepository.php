<?php

namespace App\Repositories\HistoryRepository;

use App\Interfaces\histories\StoreHistoryInterface;
use App\Models\History;

class StoreHistoryRepository implements StoreHistoryInterface
{

    public function execute(string $action, int $document_id): History
    {
        $history = new History();
        $history->action = $action;
        $history->action_date = now()->format('Y-m-d H:i:s');
        $history->user_id = auth()->id ?? 1;
        $history->document_id = $document_id;

        $history->save();
        return $history;

    }
}
