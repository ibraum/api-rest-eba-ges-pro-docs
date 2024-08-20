<?php

namespace App\UseCase\HistoryUseCase;



use App\Repositories\HistoryRepository\GetDocumentHistoryRepository;
use Illuminate\Database\Eloquent\Collection;

class GetDocumentHistoryUseCase
{
   private GetDocumentHistoryRepository $getDocumentHistoryRepository;
   public function __construct(GetDocumentHistoryRepository $getDocumentHistoryRepository)
   {
       $this->getDocumentHistoryRepository = $getDocumentHistoryRepository;
   }
   public function execute(int $document_id) : Collection
   {
       return $this->getDocumentHistoryRepository->execute($document_id);
   }
}
