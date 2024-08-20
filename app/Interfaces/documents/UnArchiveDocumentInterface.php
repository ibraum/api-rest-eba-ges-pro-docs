<?php

namespace App\Interfaces\documents;


interface UnArchiveDocumentInterface
{
    public function execute(int $document_id) : string;
}
