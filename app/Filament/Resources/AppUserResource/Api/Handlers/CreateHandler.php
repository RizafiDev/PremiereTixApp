<?php

namespace App\Filament\Resources\AppUserResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\AppUserResource;
use App\Filament\Resources\AppUserResource\Api\Requests\CreateAppUserRequest;
use Illuminate\Support\Str;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = AppUserResource::class;

    public static bool $public = true;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create AppUser
     *
     * @param CreateAppUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:app_users,email',
            'password' => 'required',
        ]);
    
        $model = new (static::getModel());
        $model->fill($data); // Isi model dengan data request
        $model->password = bcrypt($data['password']); // Hash password menggunakan bcrypt
        $model->remember_token = Str::random(60); // Tambahkan remember token
        $model->save(); // Simpan ke database
    
        return static::sendSuccessResponse($model, "Successfully Created Resource");
    }
}