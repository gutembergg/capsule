<?php

namespace Tests\Feature;

use App\Actions\StudentCard\GeneratePDF;
use App\Enums\RoleEnum;
use App\Enums\SchoolEnum;
use App\Models\StudentCard;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class StudentCardStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_store_student_card_for_both_teacher_and_super_admin(): void
    {
        $this->seed(RoleSeeder::class);

        $this->mock(GeneratePDF::class, function (MockInterface $mock) {
            $mock->shouldReceive('handle')->once();
        });

        $user = User::factory()
            ->create()
            ->assignRole(
                fake()->randomElement([RoleEnum::SUPER_ADMIN->value, RoleEnum::SUPER_ADMIN->value])
            );

        $this->actingAs($user)
            ->post(route('student-cards.store'), [
                'user_id' => $userId = User::factory()->create()->id,
                'school' => $school = fake()->randomElement(SchoolEnum::cases())->value,
                'description' => $description = Str::random(16),
                'is_internal' => $is_internal = fake()->boolean,
                'date_of_birth' => $date = Carbon::create(2000, 1, 1)->format('Y-m-d'),
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

    public function test_can_not_store_student_card_for_student(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()
            ->create()
            ->assignRole(
                RoleEnum::STUDENT->value
            );

        $this->actingAs($user)
            ->post(route('student-cards.store'), [
                'user_id' => User::factory()->create()->id,
                'school' => fake()->randomElement(SchoolEnum::cases())->value,
                'description' => Str::random(16),
                'is_internal' => fake()->boolean,
                'date_of_birth' => Carbon::create(2000, 1, 1)->format('Y-m-d'),
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('student_cards', 0);
    }

    public function test_can_not_store_student_card(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::factory()->create()->assignRole(
            fake()->randomElement([RoleEnum::SUPER_ADMIN->value, RoleEnum::SUPER_ADMIN->value])
        );

        $this->actingAs($user)
            ->post(route('student-cards.store'), [
                'description' => Str::random(2),
                'date_of_birth' => Carbon::create(2000, 1, 1)->format('d-m-Y'),
            ])
            ->assertSessionHasErrors([
                'user_id',
                'school',
                'description',
                'date_of_birth',

            ]);

        $this->assertDatabaseCount('student_cards', 0);
    }
}
