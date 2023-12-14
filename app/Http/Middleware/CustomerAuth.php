<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Customer::where('email', $request->email)->get();
        // Log::info('Received token: ' . $request->header('Authorization'));

        Log::info($request->email);

        if (count($user) > 0) {

            return $next($request);
        }
        return response()->json([
            'error' => 'Unauthenticated',
        ]);
    }
}
