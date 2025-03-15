<?php

namespace App\Filament\Resources\AppUserResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\AppUserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Filament\Resources\AppUserResource\Api\Requests\LoginRequest;
use App\Models\AppUser;

class LoginHandler extends Handlers
{
    public static string | null $uri = '/login';
    public static string | null $resource = AppUserResource::class;

    public static bool $public = true;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Handle Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Cari user berdasarkan email
        $user = AppUser::where('email', $data['email'])->first();
    
        // Periksa apakah user ada dan password cocok
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah',
            ], 401);
        }
    
        // Generate remember token (jika diperlukan)
        $rememberToken = $user->remember_token ?? Str::random(60);
        $user->update(['remember_token' => $rememberToken]);
    
        // Kirim respons sukses
        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'remember_token' => $rememberToken,
        ], 200);
    }
}