<?php

use App\Enums\SchoolEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_cards', function (Blueprint $table) {
            $table->id();
            $table->string('school')->default(SchoolEnum::ROUSSEAU->value);
            $table->text('description')->nullable();
            $table->boolean('is_internal')->default(false);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->date('date_of_birth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_cards');
    }
};
