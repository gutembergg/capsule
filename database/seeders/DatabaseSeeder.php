<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\StudentCard;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(9)->create();

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
        ]);

        User::factory(10)->has(StudentCard::factory())->create();
    }
}
