<?php

namespace App\UseCase\DocumentUseCase;


use App\Http\Requests\documentRequest\DocumentRequest;
use App\Models\Document;
use App\Repositories\DocumentRepository\CreateDocumentRepository;

class CreateDocumentUseCase
{
    private CreateDocumentRepository $createDocumentRepository;
    public function __construct(CreateDocumentRepository $createDocumentRepository)
    {
        $this->createDocumentRepository = $createDocumentRepository;
    }

    public function execute(DocumentRequest $request, string $path): Document
    {
        return $this->createDocumentRepository->execute($request, $path);
    }
}
