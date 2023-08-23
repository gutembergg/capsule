<?php

namespace App\Repository;

use App\Contracts\StudentCardRepositoryInterface;
use App\Enums\SchoolEnum;
use App\Models\User;
use Illuminate\Http\Request;

class StudentCardRepository implements StudentCardRepositoryInterface
{
    public function index(): void
    {
    }

    public function create(): array
    {
        $users = User::whereNot('id', auth()->id())->get();
        $schools = SchoolEnum::cases();

        return [
            'users' => $users,
            'schools' => $schools
        ];
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
