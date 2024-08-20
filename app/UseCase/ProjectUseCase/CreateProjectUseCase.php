<?php

namespace App\UseCase\ProjectUseCase;

use App\Http\Requests\projectRequest\ProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository\CreateProjectRepository;

class CreateProjectUseCase
{
    private CreateProjectRepository $createProjectRepository;

    public function __construct(CreateProjectRepository $createProjectRepository)
    {
        $this->createProjectRepository = $createProjectRepository;
    }

    public function execute(ProjectRequest $request): Project
    {
        return $this->createProjectRepository->execute($request);
    }
}
