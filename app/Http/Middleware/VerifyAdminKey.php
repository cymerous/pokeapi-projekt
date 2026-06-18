<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAdminKey
{
    /**
     * verification of admin key
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $req, Closure $next): Response
    {
        $key = $req->header('X-SUPER-SECRET-KEY');
        $validKey = env('ADMIN_KEY');

        if (!$key || $key !== $validKey) return response()->json([
            'message' => 'Unauthorized.'
        ], 401);

        return $next($req);
    }
}
