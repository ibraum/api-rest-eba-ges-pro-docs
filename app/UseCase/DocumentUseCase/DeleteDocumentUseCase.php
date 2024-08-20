<?php

namespace App\UseCase\DocumentUseCase;

use App\Repositories\DocumentRepository\DeleteDocumentRepository;

class DeleteDocumentUseCase
{
    private DeleteDocumentRepository $deleteDocumentRepository;

    public function __construct(DeleteDocumentRepository $deleteDocumentRepository)
    {
        $this->deleteDocumentRepository = $deleteDocumentRepository;
    }

    public function execute(int $document_id): string
    {
        return $this->deleteDocumentRepository->execute($document_id);
    }
}
