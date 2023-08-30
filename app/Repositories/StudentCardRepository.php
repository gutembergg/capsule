<?php

namespace App\Repositories;

use App\Contracts\StudentCardRepositoryInterface;
use App\Enums\SchoolEnum;
use App\Http\Requests\StudentCard\StudentCardRequest;
use App\Models\StudentCard;
use App\Models\User;

class StudentCardRepository implements StudentCardRepositoryInterface
{
    public function index(): array
    {
        return [];
    }

    /**
     * @return array<mixed>
     */
    public function create(): array
    {
        $users = User::whereNot('id', auth()->id())->get();
        $schools = SchoolEnum::cases();

        return [
            'users' => $users,
            'schools' => $schools,
        ];
    }

    public function store(StudentCardRequest $request): StudentCard
    {
        return StudentCard::create($request->validated());
    }

    public function update(StudentCard $data, string $id): void
    {
    }

    public function destroy(string $id): void
    {
    }
}
