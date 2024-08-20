<?php

namespace App\Repositories\HistoryRepository;

use App\Interfaces\histories\GetHistoryInterface;
use App\Models\History;
use Illuminate\Database\Eloquent\Collection;

class GetHistoryRepository implements GetHistoryInterface
{

    public function execute(): Collection
    {
        return History::with(['user','document'])->get();
    }
}
