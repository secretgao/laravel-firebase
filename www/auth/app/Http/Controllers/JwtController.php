<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\JWTService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JwtController extends Controller
{
    private $jwtService;
    private $userService;

    public function __construct() {

        $this->jwtService = new JWTService();
        $this->userService = new UserService();
        // 禁用 CSRF 保护
        $this->middleware('csrf', ['except' => ['index','me']]);
    }

    public function index(LoginRequest $request): JsonResponse{

        $validated = $request->validated();
        $username = $validated['username'];
        $password = $validated['password'];

        if ($this->userService->authenticate($username, $password)) {
            $jwt = $this->jwtService->generateJWT($username);
            Session::put('jwt_token', $jwt);
            return response()->json([
                'token' => $jwt,
                'status'=>200,
                'redirect_url'=>route('home')
            ],200);
        } else {
            return response()->json(['message' => 'Invalid credentials','status'=>401], 401);
        }
    }

    public function me(Request $request){

        return response()->json([
            'user' => $request->user,
            'status'=>200,
        ],200);

    }
}
