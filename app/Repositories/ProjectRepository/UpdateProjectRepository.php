<?php

namespace App\Repositories\ProjectRepository;


use App\Http\Requests\projectRequest\UpdateProjectRequest;
use App\Interfaces\projects\UpdateProjectInterface;
use App\Models\Project;

class UpdateProjectRepository implements UpdateProjectInterface
{

    public function execute(UpdateProjectRequest $request, int $project_id): Project
    {
        $project = Project::all()->find($project_id);
        $project->libel = $request->input('libel');
        $project->client_name = $request->input('client_name');
        $project->begin_date = $request->input('begin_date');
        $project->end_date = $request->input('end_date');
        $project->save();

        return $project;
    }
}
