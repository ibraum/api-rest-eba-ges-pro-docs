<?php

namespace App\UseCase\DocumentUseCase;


use App\Repositories\DocumentRepository\ListDocumentRepository;
use Illuminate\Database\Eloquent\Collection;

class ListDocumentUseCase
{
    private ListDocumentRepository $listDocumentRepository;

    public function __construct(ListDocumentRepository $listDocumentRepository)
    {
        $this->listDocumentRepository = $listDocumentRepository;
    }

    public function execute(): Collection
    {
        return $this->listDocumentRepository->execute();
    }
}
