<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuppliersCreate extends FormRequest
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
            'name' => 'required|unique:suppliers,name',
            'email' => 'email'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'أسم المورد مطلوب',
            'name.unique' => 'أسم المورد تم أستخدامه مسبقاً',
            'email.email' => 'يجب إدخال بريد ألكتروني صحيح',
        ];
    }
}
