<?php 
namespace App\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\GetUsersRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;        
    }

    public function store(StoreUserRequest $request): UserResource
    {
        $user = $this->userService->createUser($request->validated());
        
        return new UserResource($user);
    }

    public function index(GetUsersRequest $request): JsonResponse
    {
        $filters = $request->validatedWithDefaults();
        $users = $this->userService->getUsers($filters);

        $collection = UserResource::collection($users);
        
        return response()->json([
            'page' => $users->currentPage(),
            'users' => $collection->resolve(),
            'meta' => [
                'per_page' => $users->perPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total()
            ]
        ]);
    }
    
}