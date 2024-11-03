<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthInfoResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class AuthLoginController extends Controller
{
    public function __construct(
        private readonly FirebaseAuth $auth,
    ) {}

    public function __invoke(Request $request)
    {
        $id_token = $request->id_token;
        Log::debug('id_token: ' . $id_token);

        try {
            $leeway = 60;
            $verified_id_token = $this->auth->verifyIdToken($id_token, false, $leeway);
        } catch (FailedToVerifyToken $e) {
            Log::error("token is invalid: " . $e);
            return response()->json([
                'message' => 'Token is invalid'
            ], 400);
        }

        $firebase_uid = $verified_id_token->claims()->get('sub');
        Log::info('firebase_uid: ' . $firebase_uid);
        $user = User::where('firebase_uid', $firebase_uid)->first();
        if (!$user) {
            Log::error('user is not found');
            return response()->json([
                'message' => 'Token is invalid'
            ], 400);
        }
        // $user = User::factory()->create();

        Auth::loginUsingId($user->id);
        return (new AuthInfoResource($user))->response();
    }
}
