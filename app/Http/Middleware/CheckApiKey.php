<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckApiKey
{
    public function handle(Request $request, Closure $next)
    {
        // Obtener el token del header Authorization
        $apiKey = $request->bearerToken();

        if (!$apiKey) {
            return response()->json(['error' => 'API Key requerida'], 401);
        }

        // Verificar en base de datos (como en tu install.php)
        $exists = DB::table('api_keys')
                    ->where('api_key', $apiKey)
                    ->where('active', true)
                    ->exists();

        if (!$exists) {
            return response()->json(['error' => 'API Key inválida'], 401);
        }

        return $next($request);
    }
}