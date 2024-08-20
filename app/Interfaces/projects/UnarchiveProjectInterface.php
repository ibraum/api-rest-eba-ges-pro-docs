<?php

namespace App\Interfaces\projects;

use App\Http\Requests\projectRequest\UnarchiveProjectRequest;
use App\Models\Project;

interface UnarchiveProjectInterface
{
    public function execute(UnarchiveProjectRequest $request) : Project;
}
