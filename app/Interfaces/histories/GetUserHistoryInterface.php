<?php

namespace App\Interfaces\histories;

use Illuminate\Database\Eloquent\Collection;

interface GetUserHistoryInterface
{
    public function execute(int $user_id) : Collection;
}
