<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContainersCreate extends FormRequest
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
            'cont_no' => 'required|unique:containers,cont_no',
        ];
    }

    public function messages()
    {
        return [
            'cont_no.required' => 'رقم الوجبة مطلوب',
            'cont_no.unique' => 'رقم الوجبة تم أستخدامه مسبقاً'
        ];
    }
}
