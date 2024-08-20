<?php

namespace App\UseCase\ProjectUseCase;


use App\Http\Requests\projectRequest\ArchiveProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository\ArchiveProjectRepository;

class ArchiveProjectUseCase
{
    private ArchiveProjectRepository $archiveProjectRepository;

    public function __construct(ArchiveProjectRepository $archiveProjectRepository)
    {
        $this->archiveProjectRepository = $archiveProjectRepository;
    }

    public function execute(ArchiveProjectRequest $request): Project
    {
        return $this->archiveProjectRepository->execute($request);
    }
}
