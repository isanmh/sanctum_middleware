<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // public varible header
    public const header = [
        'X-PARTNER-ID' => '123456',
        'X-EXTERNAL-ID' => '123456',
        'X-SIGNATURE' => '123456'
    ];

    // register
    public function register(Request $request)
    {
        // validate request
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        // masukan data ke database
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            // 'password' => Hash::make($fields['password']),
        ]);
        // create token
        $token = $user->createToken('TokenBankIndonesia')->plainTextToken;
        $responses = [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
            'headers' => self::header
        ];
        return response($responses, 201);
    }

    // login
    public function login(Request $request)
    {
        // validate request
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        // cek email
        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 404);
        }
        $token = $user->createToken('TokenBankIndonesia')->plainTextToken;
        $responses = [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
            'headers' => self::header
        ];
        return response($responses, 201);
    }

    // logout
    public function logout()
    {
        auth()->user()->tokens->each(function ($token) {
            $token->delete();
        });
        return response([
            'message' => 'Logged out',
            'status' => 200
        ]);
    }
    // detail user
    public function user()
    {
        return response()->json([
            'user' => auth()->user(),
            'status' => 200
        ]);
    }
}
