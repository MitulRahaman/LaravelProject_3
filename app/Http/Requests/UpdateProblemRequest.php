<?php

namespace App\Http\Requests;

use App\Enums\ProblemStatus;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProblemRequest extends FormRequest
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
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'status' => ['string', Rule::in(array_column(ProblemStatus::cases(), 'value'))],
            'attachment' => ['sometimes', 'file', 'mimes:jpg,jpeg,png,bmp,pdf'],
        ];
    }
}
