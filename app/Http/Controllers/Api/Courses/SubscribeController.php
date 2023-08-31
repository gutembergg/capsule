<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        /**
         * @var User
         */
        $user = auth()->user();

        $result = $user->courses()->toggle($request->id);

        return response()->json(
            [
                'success' => true,
                'attached' => ! empty($result['attached']),
            ]
            );
    }
}