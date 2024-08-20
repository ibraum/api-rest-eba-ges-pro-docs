<?php

namespace App\UseCase\DocumentUseCase;


use App\Repositories\DocumentRepository\UnArchiveDocumentRepository;

class UnArchiveDocumentUseCase
{
    private UnArchiveDocumentRepository $unArchiveDocumentRepository;

    public function __construct(UnArchiveDocumentRepository $unArchiveDocumentRepository)
    {
        $this->unArchiveDocumentRepository = $unArchiveDocumentRepository;
    }

    public function execute(int $document_id): string
    {
        return $this->unArchiveDocumentRepository->execute($document_id);
    }
}
