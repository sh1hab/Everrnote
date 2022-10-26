<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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
            $user = new User();
            $user->id = (string)Str::orderedUuid();
            $user->name = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->email;
            $user->save();

            $token = $user->createToken('main')->plainTextToken;

            return $this->sendResponse([
                'message' => __("global.register_success"),
                'token' => $token,
            ]);
        } catch (Exception $e) {
            return $this->sendError((array)$e->getMessage(), 500);
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
            return $this->sendError((array)'Credentials do not match', 422);
        }

        $token = Auth::user()->createToken('main')->plainTextToken;

        return $this->sendResponse([
            'message' => __("global.login_success"),
            'user' => Auth::user(),
            'token' => $token,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        $user = Auth::user()->load(['uploads']);

        return $this->sendResponse([
            'message' => __("global.success"),
            'user' => new AuthResource($user),
        ]);
    }

    /**
     * @return JsonResponse
     */
    function logout()
    {
        // revokes the token that was used to authenticate the current request...
        Auth::user()->currentAccessToken()->delete();

        return $this->sendResponse([], false, 204);
    }
}
