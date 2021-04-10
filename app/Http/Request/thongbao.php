<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class thongbao extends FormRequest
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
            'tenmonhoc' => 'required',
            'ghichu' => 'required',
        ];
    }
	public function messages()
{
    return [
        'required' => 'Không được để trống',
        'required' => 'Không được để trống',
    ];
}
}
