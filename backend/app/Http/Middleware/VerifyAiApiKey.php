<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyAiApiKey
{
    public function handle(Request $request, Closure $next)
    {
        if (
            $request->header('X-AI-API-KEY')
            !== config('services.ai.api_key')
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.'
            ], 401);
        }

        return $next($request);
    }
}