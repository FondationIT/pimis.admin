<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\ApiKey;

class ValidateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Excluded endpoints
        // $excluded = [
        //     'fp/card-member/*', // wildcard pattern
        // ];

        // $is_api_provided = false;

        // foreach ($excluded as $path) {
        //     if ($request->is($path)) {
        //         $is_api_provided = true;
        //         break;
        //         // return $next($request);
        //     }
        // }
        
        $providedKey = $request->header('X-API-KEY');
        $request->attributes->set('api_key_valid', false);

        if (!$providedKey) {
            // return response()->json(['status' => 'error', 'message' => 'API key required'], 401);
            return $next($request);
        }

        $apiKey = ApiKey::where('key', $providedKey)->where('is_active', 1)->where('name','Admin System')->first();

        if (!$apiKey) {
            return response()->json(['status' => 'error', 'message' => 'Invalid or not allowed API key'], 403);
        }

        // Pass the request and attach the apiKey for later use if needed
        $request->attributes->set('apiKey', $apiKey);
        $request->attributes->set('api_key_valid', true);

        return $next($request);
    }
}
