<?php

namespace App\UseCase\HistoryUseCase;

use App\Repositories\HistoryRepository\GetUserHistoryRepository;
use Illuminate\Database\Eloquent\Collection;

class GetUserHistoryUseCase
{
    private GetUserHistoryRepository $getUserHistoryRepository;
    public function __construct(GetUserHistoryRepository $getUserHistoryRepository)
    {
        $this->getUserHistoryRepository = $getUserHistoryRepository;
    }
    public function execute(int $user_id) : Collection
    {
        return $this->getUserHistoryRepository->execute($user_id);
    }
}
