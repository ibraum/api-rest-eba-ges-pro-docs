<?php

namespace App\Interfaces\projects;


use Illuminate\Support\Collection;

interface ListProjectInterface
{
    public function execute() : Collection;
}
