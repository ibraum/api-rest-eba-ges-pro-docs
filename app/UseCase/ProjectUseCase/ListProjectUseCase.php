<?php

namespace App\UseCase\ProjectUseCase;

use App\Repositories\ProjectRepository\ListProjectRepository;
use Illuminate\Support\Collection;

class ListProjectUseCase
{
    private ListProjectRepository $listProjectRepository;

    public function __construct(ListProjectRepository $listProjectRepository)
    {
        $this->listProjectRepository = $listProjectRepository;
    }

    public function execute(): Collection
    {
        return $this->listProjectRepository->execute();
    }
}
