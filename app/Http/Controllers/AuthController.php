<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Config\Exception\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'error' => 'Usuário não encontrado'
            ], 401);
        }

        $passwordCheck = Hash::check($request->password, $user->password);

        if (!$passwordCheck) {
            return response()->json([
                'error' => 'Senha incorreta'
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user,
        ]);
    }
}
