<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomersPaymentsCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required',
            'date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'مبلغ التسديد مطلوب',
            'date.required' => 'تاريخ التسديد مطلوب'
        ];
    }
}
