<?php

namespace App\DTOS;

use App\Enums\SchoolEnum;
use Illuminate\Support\Collection;

class StudentCardCreateDTO
{
    public function __construct(
        public readonly Collection $users,
        public readonly mixed $schools,
    ) {
    }
}
