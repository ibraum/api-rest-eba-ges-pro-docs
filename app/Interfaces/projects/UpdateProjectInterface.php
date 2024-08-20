<?php

namespace App\Interfaces\projects;


use App\Http\Requests\projectRequest\UpdateProjectRequest;
use App\Models\Project;

interface UpdateProjectInterface
{
    public function execute(UpdateProjectRequest $request, int $project_id) : Project;
}
