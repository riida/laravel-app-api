<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthInfoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthInfoController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(Request $request)
    {
        $user = new AuthInfoResource(Auth::user());

        return $user->response();
    }
}
