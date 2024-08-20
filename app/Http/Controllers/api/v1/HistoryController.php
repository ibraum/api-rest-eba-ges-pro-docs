<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryResource;
use App\UseCase\HistoryUseCase\GetDocumentHistoryUseCase;
use App\UseCase\HistoryUseCase\GetHistoryUseCase;
use App\UseCase\HistoryUseCase\GetUserHistoryUseCase;
use App\UseCase\HistoryUseCase\RemoveHistoryUseCase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HistoryController extends Controller
{
    private GetHistoryUseCase $getHistoryUseCase;
    private GetDocumentHistoryUseCase $getDocumentHistoryUseCase;
    private GetUserHistoryUseCase $getUserHistoryUseCase;
    private RemoveHistoryUseCase $removeHistoryUseCase;

    public function __construct(
        GetHistoryUseCase $getHistoryUseCase,
        GetDocumentHistoryUseCase $getDocumentHistoryUseCase,
        GetUserHistoryUseCase $getUserHistoryUseCase,
        RemoveHistoryUseCase $removeHistoryUseCase
    ) {
        $this->getHistoryUseCase = $getHistoryUseCase;
        $this->getDocumentHistoryUseCase = $getDocumentHistoryUseCase;
        $this->getUserHistoryUseCase = $getUserHistoryUseCase;
        $this->removeHistoryUseCase = $removeHistoryUseCase;
    }

    /**
     * @OA\Get(
     *     path="/api/history/list",
     *     summary="Get all histories",
     *     description="Retrieve a list of all histories.",
     *     tags={"History"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/HistoryResource")
     *         ),
     *     ),
     * )
     */
    public function getHistories(): AnonymousResourceCollection
    {
        return HistoryResource::collection($this->getHistoryUseCase->execute());
    }

    /**
     * @OA\Get(
     *     path="/api/history/{document_id}/document",
     *     summary="Get document history",
     *     description="Retrieve the history of a specific document by its ID.",
     *     tags={"History"},
     *     @OA\Parameter(
     *         name="document_id",
     *         in="path",
     *         description="ID of the document whose history is to be retrieved",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/HistoryResource")
     *         ),
     *     ),
     * )
     */
    public function getDocumentHistory(int $document_id): AnonymousResourceCollection
    {
        return HistoryResource::collection($this->getDocumentHistoryUseCase->execute($document_id));
    }

    /**
     * @OA\Get(
     *     path="/api/history/{user_id}/user",
     *     summary="Get user history",
     *     description="Retrieve the history of a specific user by their ID.",
     *     tags={"History"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         description="ID of the user whose history is to be retrieved",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/HistoryResource")
     *         ),
     *     ),
     * )
     */
    public function getUserHistory(int $user_id): AnonymousResourceCollection
    {
        return HistoryResource::collection($this->getUserHistoryUseCase->execute($user_id));
    }

    /**
     * @OA\Delete(
     *     path="/api/history/delete",
     *     summary="Remove history",
     *     description="Remove all histories.",
     *     tags={"History"},
     *     @OA\Response(
     *         response=200,
     *         description="All histories removed",
     *         @OA\JsonContent(type="string")
     *     ),
     * )
     */
    public function removeHistory(): string
    {
        return $this->removeHistoryUseCase->execute();
    }
}
