<?php

namespace App\Repositories\ProjectRepository;


use App\Http\Requests\projectRequest\UnarchiveProjectRequest;
use App\Interfaces\projects\UnarchiveProjectInterface;
use App\Models\Project;

class UnarchiveProjectRepository implements UnarchiveProjectInterface
{

    public function execute(UnarchiveProjectRequest $request): Project
    {
        $project = Project::onlyTrashed()->find($request->input('project_id'));
        $project->restore();

        return $project;
    }
}
