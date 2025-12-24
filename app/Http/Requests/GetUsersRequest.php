<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetUsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array 
    {
        return [
            'search' => ['sometimes', 'string'],
            'page' => ['sometimes', 'integer', 'min:1'],
            'sortBy' => ['sometimes', 'in:name,email,created_at']
        ];
    }

    public function validatedWithDefaults(): array
    {
        return [
            'search' => $this->input('search'),
            'page' => $this->input('page', 1),
            'sortBy' => $this->input('sortBy', 'created_at')
        ];
    }
}