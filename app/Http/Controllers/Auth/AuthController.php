<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;


class AuthController extends Controller
{
    public function create(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        
        $requestData['password'] = Hash::make($requestData['password']);

        $user = User::create($requestData);
        
        Auth::login($user);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;
        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'Enregistrement effectué avec succès.'
        ];

        return response()->json($response,200);
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            
            if ($user instanceof \App\Models\User) 
                $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'Connexion réussie'
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Echec de connexion'
            ];
            return response()->json($response, 401);
        }
    }

    public function getCurrentUser(Request $request)
    {
        $user = $request->user();

        return response()->json(['user' => $user], 200);
    }

    public function destroy()
    {
        Auth::logout();
        $response = ['message' => 'Déconnexion réussie'];
        return response($response, 200);
    }
}