<?php

namespace App\Http\Controllers\Auth\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $user->token()->revoke();

        return response()->json([
            'data' => [
                'message' => 'User logged out successfully',
            ]
        ]);
    }
}