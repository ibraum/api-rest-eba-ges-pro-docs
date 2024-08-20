<?php

namespace App\UseCase\DocumentUseCase;


use App\Repositories\DocumentRepository\ListArchiveDocumentRepository;
use Illuminate\Database\Eloquent\Collection;

class ListArchiveDocumentUseCase
{
    private ListArchiveDocumentRepository $listArchiveDocumentRepository;

    public function __construct(ListArchiveDocumentRepository $listArchiveDocumentRepository)
    {
        $this->listArchiveDocumentRepository = $listArchiveDocumentRepository;
    }

    public function execute(): Collection
    {
        return $this->listArchiveDocumentRepository->execute();
    }
}
