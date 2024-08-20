<?php

namespace App\Repositories\ProjectRepository;


use App\Http\Requests\projectRequest\ProjectRequest;
use App\Interfaces\projects\CreateProjectInterface;
use App\Models\Project;

class CreateProjectRepository implements CreateProjectInterface
{

    public function execute(ProjectRequest $request): Project
    {
        $project = new Project();
        $project->libel = $request->input('libel');
        $project->client_name = $request->input('client_name');
        $project->begin_date = $request->input('begin_date');
        $project->end_date = $request->input('end_date');
        $project->user_id = $request->input('user_id');
        $project->save();

        return $project;
    }
}
