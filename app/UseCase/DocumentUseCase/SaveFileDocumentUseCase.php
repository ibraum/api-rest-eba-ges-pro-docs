<?php

namespace App\UseCase\DocumentUseCase;


use App\Repositories\DocumentRepository\SaveFileDocumentRepository;
use Illuminate\Http\UploadedFile;

class SaveFileDocumentUseCase
{
    private SaveFileDocumentRepository $saveFileDocumentRepository;

    public function __construct(SaveFileDocumentRepository $saveFileDocumentRepository)
    {
        $this->saveFileDocumentRepository = $saveFileDocumentRepository;
    }

    public function execute(UploadedFile $path): string
    {
        return $this->saveFileDocumentRepository->execute($path);
    }
}
