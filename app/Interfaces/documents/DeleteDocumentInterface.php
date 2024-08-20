<?php

namespace App\Interfaces\documents;


interface DeleteDocumentInterface
{
    public function execute(int $document_id) : string;
}
