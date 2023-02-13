<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Residents;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = request(['name', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            $user = User::where('name', $request->name)->first();

            if ($user->status == 'non-active') {
                return response()->json(['error' => 'Unauthorized'], 401);
            } else {
                if ($user->permission === 'resident') {
                    $resident = Residents::where('remember_token', $user->remember_token)->first();
                    $resident_id = $resident->id;

                    return response()->json([
                        'message' => 'User Logged In Successfully',
                        'token' => $user->remember_token,
                        'permission' => $user->permission,
                        'resident_id' => $resident_id
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'User Logged In Successfully',
                        'token' => $user->remember_token,
                        'permission' => $user->permission
                    ], 200);
                }
            }
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
