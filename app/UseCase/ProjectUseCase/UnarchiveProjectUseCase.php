<?php

namespace App\UseCase\ProjectUseCase;


use App\Http\Requests\projectRequest\UnarchiveProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository\UnarchiveProjectRepository;

class UnarchiveProjectUseCase
{
    private UnarchiveProjectRepository $unarchiveProjectRepository;

    public function __construct(UnarchiveProjectRepository $unarchiveProjectRepository)
    {
        $this->unarchiveProjectRepository = $unarchiveProjectRepository;
    }

    public function execute(UnarchiveProjectRequest $request): Project
    {
        return $this->unarchiveProjectRepository->execute($request);
    }
}
