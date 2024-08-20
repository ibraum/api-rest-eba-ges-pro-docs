<?php

namespace App\Interfaces\histories;

use Illuminate\Database\Eloquent\Collection;

interface GetDocumentHistoryInterface
{
    public function execute(int $document_id) : Collection;
}
