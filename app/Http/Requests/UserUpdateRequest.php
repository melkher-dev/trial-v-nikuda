<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => 'string|email|max:255',
            "is_admin" => "nullable|boolean",
            "avatar" => "nullable|string|max:255",
            "address" => "nullable|string|max:255",
            "phone_number" => "nullable|string|max:255",
            "is_marketing" => "nullable|boolean",
        ];
    }
}
