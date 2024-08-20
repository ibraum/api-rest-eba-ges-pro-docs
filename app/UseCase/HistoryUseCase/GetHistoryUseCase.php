<?php

namespace App\UseCase\HistoryUseCase;

use App\Repositories\HistoryRepository\GetHistoryRepository;
use Illuminate\Database\Eloquent\Collection;

class GetHistoryUseCase
{
    private GetHistoryRepository $getHistoryRepository;
    public function __construct(GetHistoryRepository $getHistoryRepository)
    {
        $this->getHistoryRepository = $getHistoryRepository;
    }
    public function execute() : Collection
    {
        return $this->getHistoryRepository->execute();
    }
}
