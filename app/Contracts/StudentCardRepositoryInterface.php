<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface StudentCardRepositoryInterface
{
    public function index(): void;
    public function create(): array;
    public function store(Request $data): void;
    public function update(array $data, string $id): void;
    public function destroy(string $id): void;
}
