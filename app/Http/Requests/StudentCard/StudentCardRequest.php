<?php

namespace App\Http\Requests\StudentCard;

use Illuminate\Foundation\Http\FormRequest;

class StudentCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
          /*   'user_id' => 
            $table->string('school')->default(SchoolEnum::ROUSSEAU->value);
            $table->text('description')->nullable();
            $table->boolean('is_internal')->default(false);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->date('date_of_birth'); */
        ];
    }
}