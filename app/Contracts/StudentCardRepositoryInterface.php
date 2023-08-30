<?php

namespace App\Contracts;

use App\Http\Requests\StudentCard\StudentCardRequest;
use App\Models\StudentCard;
use Illuminate\Support\Collection;

interface StudentCardRepositoryInterface
{
    /**
     * @return array<Collection>
     */
    public function index(): array;

    /**
     * @return array<Collection>
     */
    public function create(): array;

    public function store(StudentCardRequest $data): StudentCard;

    public function update(StudentCard $data, string $id): void;

    public function destroy(string $id): void;
}
