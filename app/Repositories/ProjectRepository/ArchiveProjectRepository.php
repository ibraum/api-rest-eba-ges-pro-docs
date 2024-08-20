<?php

namespace App\Repositories\ProjectRepository;


use App\Http\Requests\ProjectRequest;
use App\Http\Requests\projectRequest\ArchiveProjectRequest;
use App\Interfaces\projects\ArchiveProjectInterface;
use App\Models\Project;

class ArchiveProjectRepository implements ArchiveProjectInterface
{

    public function execute(ArchiveProjectRequest $request): Project
    {
        $project = Project::all()->find($request->input('project_id'));
        $project->delete();

        return $project;
    }
}
