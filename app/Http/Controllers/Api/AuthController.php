<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends BaseApiController
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
//            DB::beginTransaction();

            $user = new User();
            $user->id = (string)Str::orderedUuid();
            $user->name = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->email;
            $user->save();

            $token = $user->createToken('main')->plainTextToken;

//            DB::commit();
//
            dd($user);

            return $this->sendResponse('authToken', $token);
        } catch (Exception $e) {
//            DB::rollback();
            return $this->sendError( $e->getMessage(), 500);
        }

    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return $this->getErrorBag('Invalid', 422, 'Credentials do not match');
        }

        return $this->sendResponse('authToken', $token);
    }

}
