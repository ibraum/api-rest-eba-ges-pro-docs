<?php

namespace App\Interfaces\documents;


interface ArchiveDocumentInterface
{
    public function execute(int $document_id) : string;
}
