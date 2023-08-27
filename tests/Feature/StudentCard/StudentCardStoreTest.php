<?php

namespace Tests\Feature;

use App\Actions\StudentCard\GeneratePDF;
use Tests\TestCase;
use App\Models\User;
use App\Enums\SchoolEnum;
use App\Models\StudentCard;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;

class StudentCardStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_store_student_card(): void
    {

        $mock = $this->mock(GeneratePDF::class, function (MockInterface $mock) {
            $mock->shouldReceive('handle')->once();
        });

        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('student-cards.store'), [
                'user_id' => $userId = User::factory()->create()->id,
                'school' => $school = fake()->randomElement(SchoolEnum::cases())->value,
                'description' => $description = Str::random(16),
                'is_internal' => $is_internal = fake()->boolean,
                'date_of_birth' => $date = Carbon::create(2000, 1, 1)->format('Y-m-d')
            ])
            ->assertRedirectToRoute('dashboard');

        $this->assertDatabaseCount('student_cards', 1);

        $studentCard = StudentCard::first();

        $this->assertEquals($studentCard->user_id, $userId);
        $this->assertEquals($studentCard->school->value, $school);
        $this->assertEquals($studentCard->description, $description);
        $this->assertEquals($studentCard->is_internal, $is_internal);
        $this->assertEquals($studentCard->date_of_birth->format('Y-m-d'), $date);
    }

    public function test_can_not_store_student_card(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('student-cards.store'), [
                'description' => Str::random(2),
                'date_of_birth' => Carbon::create(2000, 1, 1)->format('d-m-Y')
            ])
            ->assertSessionHasErrors([
                'user_id',
                'school',
                'description',
                'date_of_birth'

            ]);

        $this->assertDatabaseCount('student_cards', 0);
    }
}
