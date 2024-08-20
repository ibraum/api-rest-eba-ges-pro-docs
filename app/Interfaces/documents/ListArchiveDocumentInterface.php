<?php

namespace App\Interfaces\documents;


use Illuminate\Database\Eloquent\Collection;

interface ListArchiveDocumentInterface
{
    public function execute() : Collection;
}
