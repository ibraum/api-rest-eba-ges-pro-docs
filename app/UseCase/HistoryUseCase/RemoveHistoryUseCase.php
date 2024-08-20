<?php

namespace App\UseCase\HistoryUseCase;

use App\Repositories\HistoryRepository\RemoveHistoryRepository;

class RemoveHistoryUseCase
{
    private RemoveHistoryRepository $removeHistoryRepository;
    public function __construct(RemoveHistoryRepository $removeHistoryRepository)
    {
        $this->removeHistoryRepository = $removeHistoryRepository;
    }
    public function execute() : string
    {
        return $this->removeHistoryRepository->execute();
    }
}
