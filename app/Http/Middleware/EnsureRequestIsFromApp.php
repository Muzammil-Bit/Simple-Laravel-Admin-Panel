<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class EnsureRequestIsFromApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!isset($request->api_token)) {
            return Response(['success' => false, 'message' => 'Unauthenticated']);
        }
        $api_token = ApiToken::where('token', $request->api_token)->get();

        if (sizeof($api_token) == 0) {
            return Response(['success' => false, 'message' => 'Unauthenticated']);
        }

        return $next($request);
    }
}
