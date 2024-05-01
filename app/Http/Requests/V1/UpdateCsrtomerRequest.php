<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCsrtomerRequest extends FormRequest
{
    public function authorize(): bool
    {

        $user = $this->user();
        return $user != NULL && $user->tokenCan('update');    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $methode = $this->methode();
        if($methode == 'PUT'){

            return [
                'name' => 'required',
                'type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
                'eamil' => 'required|email',
                'state' => 'required',
                'address' => 'required',
                'city' => 'required',
                'postalCode' => 'required',
            ];
        }
        else {
            return [
                'name' => 'required|sometimes',
                'type' => ['required', 'somtimes', Rule::in(['I', 'B', 'i', 'b'])],
                'eamil' => 'required|email|sometimes',
                'state' =>  'required|sometimes',
                'address' =>  'required|sometimes',
                'city' =>'required|sometimes',
                'postalCode' =>  'required|sometimes',
            ]; 
        }
    }
    protected function prepareForValidation(){
        if($this->postalCode){

            $this->merge([
                'postal_code' => $this->postalCode,
            ]);
        }
    }
}
// {   the token used in sanctum 
// "admin": "1|laravel_sanctum_01ICrrVeI2Hl48xPZFGw5wTDaxu3humet1NujFiycec6fe90",
// "update": "2|laravel_sanctum_NgEgJHsjBsA7rPHcy50QLqepstwd3iMo4c0GM0ZBdf869eb5",
// "basic": "3|laravel_sanctum_ytaTbZuCTB0rPFOXMta42hM2gxEywhqFKzENZ9rf653d1cba"
// }