<?php

namespace App\UseCase\ProjectUseCase;


use App\Http\Requests\projectRequest\UpdateProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository\UpdateProjectRepository;

class UpdateProjectUseCase
{
    private UpdateProjectRepository $updateProjectRepository;

    public function __construct(UpdateProjectRepository $updateProjectRepository)
    {
        $this->updateProjectRepository = $updateProjectRepository;
    }

    public function execute(UpdateProjectRequest $request, int $project_id): Project
    {
        return $this->updateProjectRepository->execute($request, $project_id);
    }
}
