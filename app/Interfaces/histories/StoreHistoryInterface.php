<?php

namespace App\Interfaces\histories;

use App\Models\History;

interface StoreHistoryInterface
{
    public function execute(string $action, int $document_id) : History;
}
