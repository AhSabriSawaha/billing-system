<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        $user = $this->user();
        return $user != NULL && $user->tokenCan('create');    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            '*.customerId' => 'requtired|integer',
            '*.status' => 'requtired|numeric',
            '*.amount' => ['requtired', Rule::in(['B', 'P', 'V', 'v', 'b', 'p'])],
            '*.billedDate' => ['requtired', 'date_format:Y-m-d H:i:s'],
            '*.paidDate' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ];
    }
    protected function prepareForValidation(){
        $data =[];
        foreach($this->roArray() as $obj){
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $obj['paid_date'] = $obj['paidDate'] ?? null;
            $obj['billed_date'] = $obj['billedDate-'] ?? null;
            $date[] = $obj;
        }
        $this->merge($date);
    } 
}
