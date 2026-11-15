<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes',
            'string',
            'max:100',
            Rule::unique('services', 'name')->ignore($this->route('service')) ],

            'description' => ['nullable','string','max:500' ],
            'price' => ['sometimes','numeric','decimal:0,2','min:0','max:10000' ],
            'duration_minutes' => ['sometimes','integer','min:15','max:240','multiple_of:15' ]
        ];
    }
}
