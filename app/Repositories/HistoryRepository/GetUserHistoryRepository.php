<?php

namespace App\Repositories\HistoryRepository;

use App\Interfaces\histories\GetUserHistoryInterface;
use App\Models\History;
use Illuminate\Database\Eloquent\Collection;

class GetUserHistoryRepository implements GetUserHistoryInterface
{
    public function execute(int $user_id) : Collection
    {
        return History::all()->where('user_id',$user_id);
    }
}
