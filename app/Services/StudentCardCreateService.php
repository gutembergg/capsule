<?php

namespace App\Services;

use App\Contracts\StudentCardRepositoryInterface;
use App\Enums\SchoolEnum;
use App\Models\User;

class StudentCardCreateService
{
    public function __construct(private StudentCardRepositoryInterface $repo)
    {
    }

    public function __invoke(): array
    {
        $users = User::whereNot('id', auth()->id())->get();
        $schools = SchoolEnum::cases();
        return [
            'users' => $users,
            'schools' => $schools
        ];
    }
}
