<?php

namespace App\Repositories\ProjectRepository;


use App\Interfaces\projects\ListProjectInterface;
use App\Models\Project;
use Illuminate\Support\Collection;

class ListProjectRepository implements ListProjectInterface
{

    public function execute(): Collection
    {
        return Project::all();
    }
}
