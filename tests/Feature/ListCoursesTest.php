<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ListCoursesTest extends TestCase
{
   use RefreshDatabase;
   
    public function test_can_retrieve_courses(): void
    {
        Course::factory(5)->create();

        $this->actingAs(User::factory()->create())
            ->get(route('events'))
            ->assertOk()
            ->assertJsonStructure(['events'])
            ->assertJson(
                fn(AssertableJson $json) => $json->where('events.0.id', 1) 
            );
    }
}