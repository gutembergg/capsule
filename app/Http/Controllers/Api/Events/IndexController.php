<?php

namespace App\Http\Controllers\Api\Events;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        /**
         * @var User
         */
        $user = auth()->user();
        $coursesIds = $user->courses()->pluck('id');

        $events = Course::all()
            ->map(function (Course $course) use ($coursesIds) {

                return [
                    'id' => $coursesId = $course->id,
                    'title' => $course->title,
                    'color' => $course->color,
                    'start' => $course->starts_at->format('Y-m-d H:i:s'),
                    'end' => $course->ends_at->format('Y-m-d H:i:s'),
                    'borderColor' => $coursesIds->contains($coursesId) ? 'green' : 'yellow',
                ];
            });

        return response()->json([
            'events' => $events,
        ]);
    }
}