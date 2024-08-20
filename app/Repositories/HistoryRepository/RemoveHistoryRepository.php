<?php

namespace App\Repositories\HistoryRepository;

use App\Interfaces\histories\RemoveHistoryInterface;
use App\Models\History;

class RemoveHistoryRepository implements RemoveHistoryInterface
{

    public function execute(): string
    {
        $histories = History::all();
        if ($histories != null)
        {
            foreach ($histories as $history)
            {
                $history->forceDelete();
            }
            return "Suppression effectuée avec succès !";
        }else{
            return "L'historique est vide !";
        }
    }
}
