<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JWTAuthMiddleware
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
        $token = $request->cookie('auth_token');

        if ($token) {
            try {
                $decoded = JWT::decode($token, env('APP_KEY'), ['HS256']);
                $user = User::find($decoded->user_id);
                print_r($decoded);
                if ($user) {
                    Auth::login($user);
                }
            } catch (\Throwable $th) {
                // Do nothing
            }
        }
        
        return $next($request);
    }
}
