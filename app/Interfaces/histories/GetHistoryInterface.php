<?php

namespace App\Interfaces\histories;

use Illuminate\Database\Eloquent\Collection;

interface GetHistoryInterface
{
    public function execute() : Collection;
}
