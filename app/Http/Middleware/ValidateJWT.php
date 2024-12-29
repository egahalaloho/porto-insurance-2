<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ValidateJWT
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {   
        try {
            // Pastikan token ada dan valid
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            // Tangani error JWT
            return response()->json([
                'error' => $e->getMessage() === 'Token not provided'
                    ? 'Token not provided'
                    : 'Token is invalid or expired',
            ], 401);
        }

        // Lanjutkan permintaan jika token valid
        return $next($request);
    }
}
