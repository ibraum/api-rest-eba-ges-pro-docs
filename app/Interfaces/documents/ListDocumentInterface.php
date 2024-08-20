<?php

namespace App\Interfaces\documents;


use Illuminate\Database\Eloquent\Collection;

interface ListDocumentInterface
{
    public function execute() : Collection;
}
