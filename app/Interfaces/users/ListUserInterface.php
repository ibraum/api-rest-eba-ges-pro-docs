<?php

namespace App\Interfaces\users;


use Illuminate\Database\Eloquent\Collection;

interface ListUserInterface
{
    public function execute() : Collection;
}
