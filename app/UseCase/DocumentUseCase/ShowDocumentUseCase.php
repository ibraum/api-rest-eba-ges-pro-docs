<?php

namespace App\UseCase\DocumentUseCase;


use App\Models\Document;
use App\Repositories\DocumentRepository\ShowDocumentRepository;

class ShowDocumentUseCase
{
    private ShowDocumentRepository $showDocumentRepository;

    public function __construct(ShowDocumentRepository $showDocumentRepository)
    {
        $this->showDocumentRepository = $showDocumentRepository;
    }

    public function execute(int $document_id): Document
    {
        return $this->showDocumentRepository->execute($document_id);
    }
}
