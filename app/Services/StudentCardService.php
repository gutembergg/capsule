<?php

namespace App\Services;

use App\Contracts\StudentCardRepositoryInterface;
use App\DTOS\StudentCardCreateDTO;
use App\Http\Requests\StudentCard\StudentCardRequest;
use App\Models\StudentCard;

class StudentCardService
{
    public function __construct(private StudentCardRepositoryInterface $repo)
    {
    }

    public function create(): StudentCardCreateDTO
    {
        $data = $this->repo->create();
        $dto = new StudentCardCreateDTO($data['users'], $data['schools']);

        return $dto;
    }

    public function store(StudentCardRequest $request): StudentCard
    {
        return $this->repo->store($request);
    }
}
