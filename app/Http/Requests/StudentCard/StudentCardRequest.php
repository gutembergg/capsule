<?php

namespace App\Http\Requests\StudentCard;

use App\Enums\SchoolEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<int|string|Enum>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'school' => ['required',  new Enum(type: SchoolEnum::class)],
            'description' => ['nullable', 'min:10', 'max:700'],
            'is_internal' => ['required', 'boolean'],
            'date_of_birth' => [
                'required',
                'date_format:Y-m-d',
                'before:-12 years',
                'after:dat-50 years',
            ],

        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'is_internal' => $this->boolean('is_internal'),
        ]);
    }
}
