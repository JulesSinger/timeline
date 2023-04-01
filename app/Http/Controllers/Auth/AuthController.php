<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            return response()->json(null, 200);
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
    
    // Déconnecte l'utilisateur
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(null, 200);
    }

    public function getCurrentUser(Request $request)
    {
        $user = $request->user();

        if ($user) {
            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        } else {
            return response()->json(null, 401);
        }
    }

}