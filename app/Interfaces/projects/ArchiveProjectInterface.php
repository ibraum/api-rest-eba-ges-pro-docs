<?php

namespace App\Interfaces\projects;

use App\Http\Requests\projectRequest\ArchiveProjectRequest;
use App\Models\Project;

interface ArchiveProjectInterface
{
    public function execute(ArchiveProjectRequest $request) : Project;
}
