<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SubscribeCoursesTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_can_subscribe_to_a_courses(): void
    {
        $course = Course::factory()->create();

        $this->actingAs(User::factory()->create())
            ->put(route('subscribe', ['id' => $course]))
            ->assertOk()
            ->assertJsonStructure(['success', 'attached'])
            ->assertJson(
                fn(AssertableJson $json) => $json->where('attached', true)->etc()
            );
    }
}