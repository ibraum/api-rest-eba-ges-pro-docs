<?php

namespace App\Interfaces\projects;


use App\Http\Requests\projectRequest\ProjectRequest;
use App\Models\Project;

interface CreateProjectInterface
{
    public function execute(ProjectRequest $request) : Project;
}
