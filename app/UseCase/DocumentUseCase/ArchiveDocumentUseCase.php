<?php

namespace App\UseCase\DocumentUseCase;


use App\Repositories\DocumentRepository\ArchiveDocumentRepository;

class ArchiveDocumentUseCase
{
    private ArchiveDocumentRepository $archiveDocumentRepository;

    public function __construct(ArchiveDocumentRepository $archiveDocumentRepository)
    {
        $this->archiveDocumentRepository = $archiveDocumentRepository;
    }

    public function execute(int $document_id): string
    {
        return $this->archiveDocumentRepository->execute($document_id);
    }
}
