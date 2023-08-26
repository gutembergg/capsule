<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCard\StudentCardRequest;
use App\Services\StudentCardService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentCardController extends Controller
{
    public function __construct(private StudentCardService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = $this->service->create();

        return view('student_cards.create', ['users' => $data->users, 'schools' => $data->schools]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentCardRequest $request): void
    {
        $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
