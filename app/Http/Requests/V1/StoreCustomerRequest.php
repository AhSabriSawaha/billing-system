<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != NULL && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'requtired',
            'type' => ['requtired', Rule::in(['I', 'B', 'i', 'b'])],
            'eamil' => 'requtired|email',
            'state' => 'requtired',
            'address' => 'requtired',
            'city' => 'requtired',
            'postalCode' => 'requtired',
        ];
    }
    protected function prepareForValidation(){
        $this->merge([
            'postal_code' => $this->postalCode,
        ]);
    } 
}
