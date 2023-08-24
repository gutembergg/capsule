<?php

namespace App\Services;

use App\Contracts\StudentCardRepositoryInterface;
use Illuminate\Http\Request;

class StudentCardService
{
    public function __construct(private StudentCardRepositoryInterface $repo)
    {
    }

    public function create()
    {
        $data = $this->repo->index();
        return [
            'users' => $data['users'],
            'schools' => $data['schools']
        ];
    }

    public function store(Request $request)
    {
        return $this->repo->store($request);
    }
}
