<?php

namespace App\Interfaces\documents;

use App\Models\Document;

interface ShowDocumentInterface
{
    public function execute(int $document_id) : Document;
}
