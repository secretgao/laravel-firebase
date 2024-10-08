<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\JwtService;

class JwtMiddleware
{
    protected $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
           return redirect()->route('login');
        }

        $decoded = $this->jwtService->verifyJWT($token);
        if (!$decoded) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $request->user = $decoded;

        return $next($request);
    }
}
