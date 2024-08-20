<?php

namespace App\UseCase\DocumentUseCase;


use App\Http\Requests\documentRequest\UpdateDocumentRequest;
use App\Models\Document;
use App\Repositories\DocumentRepository\UpdateDocumentRepository;

class UpdateDocumentUseCase
{
    private UpdateDocumentRepository $updateDocumentRepository;
    public function __construct(UpdateDocumentRepository $updateDocumentRepository)
    {
        $this->updateDocumentRepository = $updateDocumentRepository;
    }

    public function execute(UpdateDocumentRequest $request, string $path, int $document_id): Document
    {
        return $this->updateDocumentRepository->execute($request, $path, $document_id);
    }
}
