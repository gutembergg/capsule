<?php

namespace App\Repositories;

use App\Contracts\StudentCardRepositoryInterface;
use App\Enums\SchoolEnum;
use App\Models\User;
use Illuminate\Http\Request;

class StudentCardRepository implements StudentCardRepositoryInterface
{
    public function index(): array
    {
        $users = User::whereNot('id', auth()->id())->get();
        $schools = SchoolEnum::cases();

        return [
            'users' => $users,
            'schools' => $schools
        ];
    }

    public function create(): array
    {
        return [];
    }

    public function store(Request $data): void
    {
    }

    public function update(array $data, string $id): void
    {
    }

    public function destroy(string $id): void
    {
    }
}
