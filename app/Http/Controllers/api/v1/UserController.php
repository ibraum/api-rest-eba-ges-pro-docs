<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\userRequest\ActiveOrDeactiveRequest;
use App\Http\Requests\userRequest\LoginRequest;
use App\Http\Requests\userRequest\UserRequest;
use App\Http\Resources\UserResource;
use App\UseCase\UserUseCase\ActiveUserUseCase;
use App\UseCase\UserUseCase\CreateUserUseCase;
use App\UseCase\UserUseCase\DeactivateUserUseCase;
use App\UseCase\UserUseCase\ListUserUseCase;
use App\UseCase\UserUseCase\LoginUserUseCase;
use App\UseCase\UserUseCase\LogoutUserUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private CreateUserUseCase $createUserUseCase;
    private ActiveUserUseCase $activeUserUseCase;
    private DeactivateUserUseCase $deactivateUserUseCase;
    private ListUserUseCase $listUserUseCase;
    private LoginUserUseCase $loginUserUseCase;
    private LogoutUserUseCase $logoutUserUseCase;

    public function __construct(
        CreateUserUseCase $createUserUseCase,
        ActiveUserUseCase $activeUserUseCase,
        DeactivateUserUseCase $deactivateUserUseCase,
        ListUserUseCase $listUserUseCase,
        LoginUserUseCase $loginUserUseCase,
        LogoutUserUseCase $logoutUserUseCase
    ) {
        $this->createUserUseCase = $createUserUseCase;
        $this->activeUserUseCase = $activeUserUseCase;
        $this->deactivateUserUseCase = $deactivateUserUseCase;
        $this->listUserUseCase = $listUserUseCase;
        $this->logoutUserUseCase = $logoutUserUseCase;
        $this->loginUserUseCase = $loginUserUseCase;
    }

    /**
     * @OA\Get(
     *     path="/api/user/list",
     *     summary="Get all users",
     *     description="Retrieve a list of all users.",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/UserResource")
     *         ),
     *     ),
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection($this->listUserUseCase->execute());
    }

    /**
     * @OA\Post(
     *     path="/api/user/create",
     *     summary="Create a new user",
     *     description="Create a new user with the provided data.",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     ),
     * )
     */
    public function store(UserRequest $request): JsonResponse
    {
        return new JsonResponse(
            data: new UserResource($this->createUserUseCase->execute($request)),
            status: Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Post(
     *     path="/api/user/login",
     *     summary="User login",
     *     description="Authenticate a user with email and password.",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(ref="#/components/schemas/UserResource"),
     *             }
     *         )
     *     ),
     * )
     */
    public function doLogin(LoginRequest $request) : UserResource
    {
            return new UserResource($this->loginUserUseCase->execute($request));
    }

    /**
     * @OA\Post(
     *     path="/api/user/logout",
     *     summary="User logout",
     *     description="Logout the authenticated user.",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout",
     *         @OA\JsonContent(type="string")
     *     ),
     * )
     */
    public function logout()
    {
        $this->logoutUserUseCase->execute();
    }

    /**
     * @OA\Post(
     *     path="/api/user/activate",
     *     summary="Activate a user",
     *     description="Activate a user account.",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActiveOrDeactiveRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User activated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     ),
     * )
     */
    public function activate(ActiveOrDeactiveRequest $request): JsonResponse
    {
        $user = $this->activeUserUseCase->execute($request);

        return new JsonResponse(
            data: new UserResource($user),
            status: Response::HTTP_OK
        );
    }

    /**
     * @OA\Post(
     *     path="/api/user/deactivate",
     *     summary="Deactivate a user",
     *     description="Deactivate a user account.",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActiveOrDeactiveRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User deactivated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     ),
     * )
     */
    public function deactivate(ActiveOrDeactiveRequest $request): JsonResponse
    {
        $user = $this->deactivateUserUseCase->execute($request);

        return new JsonResponse(
            data: new UserResource($user),
            status: Response::HTTP_OK
        );
    }
}
