<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckStaffAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $staff = Staff::where('email', $request->email)->get();
        // Log::info('Received token: ' . $request->header('Authorization'));

        Log::info($request->email);

        if (count($staff) > 0) {

            return $next($request);
        }
        return response()->json([
            'error' => 'Unauthenticated',
        ]);
    }
    // if (auth()->guard('staffs')->check()) {
    //     return $next($request);
    // }
    // return response()->json([
    //     'error' => 'unauthenticated'
    // ]);

    // Assuming you are passing the email and token in the request headers


}
