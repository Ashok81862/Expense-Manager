<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'nullable',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $device = $request->device_name ?? uniqid();
        $token = $user->createToken($device)->plainTextToken;

        return response()->json(compact('token'));
    }

    public function logout(Request $request): Response
    {
        // Get Token from Header
        $headerToken = $request->header('Authorization', null);

        $explodedString = explode('Bearer', $headerToken);

        if (is_array($explodedString) && count($explodedString) == 2) {
            $tokenId = trim($explodedString[1]);
            auth()->user()->tokens()
                ->where('id', $tokenId)->delete();
        }

        return response()->noContent();
    }

    public function checkToken(): Response
    {
        return response()->noContent();
    }

    public function user(User $user)
    {
        $user = auth()->user();

        return response()->json($user);
    }

}
