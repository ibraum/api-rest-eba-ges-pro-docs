<?php

namespace App\UseCase\HistoryUseCase;

use App\Models\History;
use App\Repositories\HistoryRepository\StoreHistoryRepository;

class StoreHistoryUseCase
{
   private StoreHistoryRepository $storeHistoryRepository;
    public function __construct(StoreHistoryRepository $storeHistoryRepository)
    {
        $this->storeHistoryRepository = $storeHistoryRepository;
    }
   public function execute(string $action, int $document_id): History
   {
       return $this->storeHistoryRepository->execute($action, $document_id);
   }
}
