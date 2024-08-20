<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\documentRequest\IDDocumentRequest;
use App\Http\Requests\documentRequest\DocumentRequest;
use App\Http\Requests\documentRequest\UpdateDocumentRequest;
use App\Http\Resources\DocumentResource;
use App\UseCase\DocumentUseCase\ArchiveDocumentUseCase;
use App\UseCase\DocumentUseCase\CreateDocumentUseCase;
use App\UseCase\DocumentUseCase\DeleteDocumentUseCase;
use App\UseCase\DocumentUseCase\ListArchiveDocumentUseCase;
use App\UseCase\DocumentUseCase\ListDocumentUseCase;
use App\UseCase\DocumentUseCase\SaveFileDocumentUseCase;
use App\UseCase\DocumentUseCase\ShowDocumentUseCase;
use App\UseCase\DocumentUseCase\UnArchiveDocumentUseCase;
use App\UseCase\DocumentUseCase\UpdateDocumentUseCase;
use App\UseCase\HistoryUseCase\StoreHistoryUseCase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    //histories actions
    private string $CREATE = "CREATE";
    private string $UPDATE = "UPDATE";
    private string $SHOW = "SHOW";
    private string $ARCHIVE = "ARCHIVE";
    private string $UNARCHIVE = "UNARCHIVE";

    //history useCase
    private StoreHistoryUseCase $storeHistoryUseCase;

    //document useCase
    private CreateDocumentUseCase $createDocumentUseCase;
    private ShowDocumentUseCase $showDocumentUseCase;
    private DeleteDocumentUseCase $deleteDocumentUseCase;
    private ArchiveDocumentUseCase $archiveDocumentUseCase;
    private UnArchiveDocumentUseCase $unArchiveDocumentUseCase;
    private UpdateDocumentUseCase $updateDocumentUseCase;
    private SaveFileDocumentUseCase $saveFileDocumentUseCase;
    private ListDocumentUseCase $listDocumentUseCase;
    private ListArchiveDocumentUseCase $listArchiveDocumentUseCase;

    public function __construct(CreateDocumentUseCase $createDocumentUseCase, ShowDocumentUseCase $showDocumentUseCase, DeleteDocumentUseCase $deleteDocumentUseCase, ArchiveDocumentUseCase $archiveDocumentUseCase, UpdateDocumentUseCase $updateDocumentUseCase,SaveFileDocumentUseCase $saveFileDocumentUseCase, ListDocumentUseCase $listDocumentUseCase, StoreHistoryUseCase $storeHistoryUseCase, ListArchiveDocumentUseCase $listArchiveDocumentUseCase, UnArchiveDocumentUseCase $unArchiveDocumentUseCase)
    {
        //document
        $this->createDocumentUseCase = $createDocumentUseCase;
        $this->showDocumentUseCase = $showDocumentUseCase;
        $this->deleteDocumentUseCase = $deleteDocumentUseCase;
        $this->archiveDocumentUseCase = $archiveDocumentUseCase;
        $this->unArchiveDocumentUseCase = $unArchiveDocumentUseCase;
        $this->updateDocumentUseCase = $updateDocumentUseCase;
        $this->saveFileDocumentUseCase = $saveFileDocumentUseCase;
        $this->listDocumentUseCase = $listDocumentUseCase;
        $this->listArchiveDocumentUseCase = $listArchiveDocumentUseCase;

        //History
        $this->storeHistoryUseCase = $storeHistoryUseCase;
    }

    /**
     * @OA\Get(
     *     path="/api/document/list",
     *     summary="Get all documents",
     *     description="Retrieve a list of all documents.",
     *     tags={"Document"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/DocumentResource")
     *         ),
     *     ),
     * )
     */
    public function index() : AnonymousResourceCollection
    {
        return DocumentResource::collection($this->listDocumentUseCase->execute());
    }

    /**
     * @OA\Post(
     *     path="/api/document/create",
     *     summary="Create a new document",
     *     description="Create a new document and store its history.",
     *     tags={"Document"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/DocumentRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Document created",
     *         @OA\JsonContent(ref="#/components/schemas/DocumentResource")
     *     ),
     * )
     */
    public function store(DocumentRequest $request) : JsonResponse
    {
        $path = '';
        if($request->file("path")){
            /**@var UploadedFile $doc*/
            $doc = $request->file("path");
            $path = $this->saveFileDocumentUseCase->execute($doc);
        }
        $document = $this->createDocumentUseCase->execute($request, $path);
        $document_id = $document->document_id;
        $this->storeHistoryUseCase->execute($this->CREATE, $document_id);

        return new JsonResponse(
            data: new DocumentResource($document),
            status: Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Get(
     *     path="/api/document/{document_id}/show",
     *     summary="Get a document",
     *     description="Retrieve a specific document by its ID.",
     *     tags={"Document"},
     *     @OA\Parameter(
     *         name="document_id",
     *         in="path",
     *         description="ID of the document to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/DocumentResource")
     *     ),
     * )
     */
    public function show(int $document_id) : DocumentResource
    {
        $this->storeHistoryUseCase->execute($this->SHOW, $document_id);
        return new DocumentResource($this->showDocumentUseCase->execute($document_id));
    }

    /**
     * @OA\Put(
     *     path="/api/document/{document_id}/update",
     *     summary="Update a document",
     *     description="Update a document by its ID.",
     *     tags={"Document"},
     *     @OA\Parameter(
     *         name="document_id",
     *         in="path",
     *         description="ID of the document to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateDocumentRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Document updated",
     *         @OA\JsonContent(ref="#/components/schemas/DocumentResource")
     *     ),
     * )
     */
    public function update(UpdateDocumentRequest $request, int $document_id) : JsonResponse
    {
        $path = null;
        if ($request->file('path'))
        {
            /**@var UploadedFile $doc*/
            $doc = $request->file("path");
            $path = $this->saveFileDocumentUseCase->execute($doc);
        }
        $document = $this->updateDocumentUseCase->execute($request, $path, $document_id);
        $this->storeHistoryUseCase->execute($this->UPDATE, $document_id);
        return new JsonResponse(
            data: new DocumentResource($document),
            status: Response::HTTP_OK
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/document/delete",
     *     summary="Delete a document",
     *     description="Delete a document by its ID.",
     *     tags={"Document"},
     *     @OA\Response(
     *         response=200,
     *         description="Document deleted",
     *         @OA\JsonContent(type="string")
     *     ),
     * )
     */
    public function destroy(IDDocumentRequest $request) : string
    {
        return $this->deleteDocumentUseCase->execute($request->input("document_id"));
    }

    /**
     * @OA\Post(
     *     path="/api/document/archive",
     *     summary="Archive a document",
     *     description="Archive a document by its ID.",
     *     tags={"Document"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/IDDocumentRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Document archived",
     *         @OA\JsonContent(type="string")
     *     ),
     * )
     */
    public function archive(IDDocumentRequest $request) : string
    {
        $document_id = $request->input("document_id");
        $this->storeHistoryUseCase->execute($this->ARCHIVE, $document_id);
        return $this->archiveDocumentUseCase->execute($document_id);
    }

    /**
     * @OA\Post(
     *     path="/api/document/unarchive",
     *     summary="Unarchive a document",
     *     description="Unarchive a document by its ID.",
     *     tags={"Document"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/IDDocumentRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Document unarchived",
     *         @OA\JsonContent(type="string")
     *     ),
     * )
     */
    public function unArchive(IDDocumentRequest $request) : string
    {
        $document_id = $request->input("document_id");
        $this->storeHistoryUseCase->execute($this->UNARCHIVE, $document_id);
        return $this->unArchiveDocumentUseCase->execute($document_id);
    }

    /**
     * @OA\Get(
     *     path="/api/documents/list/archive",
     *     summary="Get archived documents",
     *     description="Retrieve a list of archived documents.",
     *     tags={"Document"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/DocumentResource")
     *         ),
     *     ),
     * )
     */
    public function listArchive(): AnonymousResourceCollection
    {
        return DocumentResource::collection($this->listArchiveDocumentUseCase->execute());
    }
}
