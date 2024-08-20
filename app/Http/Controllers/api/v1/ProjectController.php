<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\projectRequest\ArchiveProjectRequest;
use App\Http\Requests\projectRequest\UnarchiveProjectRequest;
use App\Http\Requests\projectRequest\ProjectRequest;
use App\Http\Requests\projectRequest\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\UseCase\ProjectUseCase\ArchiveProjectUseCase;
use App\UseCase\ProjectUseCase\UnarchiveProjectUseCase;
use App\UseCase\ProjectUseCase\CreateProjectUseCase;
use App\UseCase\ProjectUseCase\ListProjectUseCase;
use App\UseCase\ProjectUseCase\UpdateProjectUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    private ArchiveProjectUseCase $archiveProjectUseCase;
    private UnarchiveProjectUseCase $unarchiveProjectUseCase;
    private CreateProjectUseCase $createProjectUseCase;
    private UpdateProjectUseCase $updateProjectUseCase;
    private ListProjectUseCase $listProjectUseCase;

    public function __construct(
        ArchiveProjectUseCase $archiveProjectUseCase,
        CreateProjectUseCase $createProjectUseCase,
        UpdateProjectUseCase $updateProjectUseCase,
        ListProjectUseCase $listProjectUseCase,
        UnarchiveProjectUseCase $unarchiveProjectUseCase
    ) {
        $this->archiveProjectUseCase = $archiveProjectUseCase;
        $this->unarchiveProjectUseCase = $unarchiveProjectUseCase;
        $this->createProjectUseCase = $createProjectUseCase;
        $this->updateProjectUseCase = $updateProjectUseCase;
        $this->listProjectUseCase = $listProjectUseCase;
    }

    /**
     * @OA\Get(
     *     path="/api/project/list",
     *     summary="Get all projects",
     *     description="Retrieve a list of all projects.",
     *     tags={"Project"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ProjectResource")
     *         ),
     *     ),
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return ProjectResource::collection($this->listProjectUseCase->execute());
    }

    /**
     * @OA\Post(
     *     path="/api/project/create",
     *     summary="Create a new project",
     *     description="Create a new project with the provided data.",
     *     tags={"Project"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProjectRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Project created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ProjectResource")
     *     ),
     * )
     */
    public function create(ProjectRequest $request): JsonResponse
    {
        $project = $this->createProjectUseCase->execute($request);

        return new JsonResponse(
            data: new ProjectResource($project),
            status: Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Post(
     *     path="/api/project/archive",
     *     summary="Archive a project",
     *     description="Archive a project based on the provided data.",
     *     tags={"Project"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ArchiveProjectRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Project archived successfully",
     *         @OA\JsonContent(type="string")
     *     ),
     * )
     */
    public function archive(ArchiveProjectRequest $request)
    {
        $this->archiveProjectUseCase->execute($request);
    }

    /**
     * @OA\Post(
     *     path="/api/project/unarchive",
     *     summary="Unarchive a project",
     *     description="Unarchive a project based on the provided data.",
     *     tags={"Project"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UnarchiveProjectRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Project unarchived successfully",
     *         @OA\JsonContent(type="string")
     *     ),
     * )
     */
    public function unArchive(UnarchiveProjectRequest $request)
    {
        $this->unarchiveProjectUseCase->execute($request);
    }

    /**
     * @OA\Put(
     *     path="/api/project/{project_id}/edit",
     *     summary="Update a project",
     *     description="Update an existing project with the provided data.",
     *     tags={"Project"},
     *     @OA\Parameter(
     *         name="project_id",
     *         in="path",
     *         description="ID of the project to be updated",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateProjectRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Project updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ProjectResource")
     *     ),
     * )
     */
    public function update(UpdateProjectRequest $request, int $project_id): JsonResponse
    {
        $project = $this->updateProjectUseCase->execute($request, $project_id);

        return new JsonResponse(
            data: new ProjectResource($project),
            status: Response::HTTP_OK
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/project/delete",
     *     summary="Delete a project",
     *     description="Delete a project by its ID.",
     *     tags={"Project"},
     *     @OA\Response(
     *         response=200,
     *         description="Project deleted successfully",
     *         @OA\JsonContent(type="string")
     *     ),
     * )
     */
    public function destroy(Project $project)
    {
        //
    }
}
