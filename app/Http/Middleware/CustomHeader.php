<?php

namespace App\Http\Middleware;

use App\Http\Controllers\API\AuthController;
use Closure;
use Illuminate\Http\Request;

class CustomHeader
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
        // logika custom header
        $ah = AuthController::header;
        $res1 = $request->header('X-PARTNER-ID');
        $res2 = $request->header('X-EXTERNAL-ID');
        $res3 = $request->header('X-SIGNATURE');

        if (
            $res1 === $ah['X-PARTNER-ID'] &&
            $res2 === $ah['X-EXTERNAL-ID'] &&
            $res3 === $ah['X-SIGNATURE']
        ) {
            return $next($request);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Header ada yang kosong'
            ]);
        }
    }
}
