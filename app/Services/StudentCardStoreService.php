<?php

namespace App\Services;

use App\Contracts\StudentCardRepositoryInterface;
use Illuminate\Http\Request;

class StudentCardStoreService
{
    public function __construct(private StudentCardRepositoryInterface $repo)
    {
    }

    public function __invoke(Request $request)
    {
        return $this->repo->store($request);
    }
}
