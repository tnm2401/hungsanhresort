<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;
class TranslationRequest extends FormRequest
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
    public function rules(){
        $rules = Validator::make(request()->translation,[
            '*.slug' =>'required| unique:translations',
            '*.name' => 'required',
        ]);

        return $rules->validate();

        // return [
        //     '*.slug' =>'required| unique:translations',
        //     '*.name' => 'required',
        // ];
    }

    public function messages()
    {
        return [
            '*.name.required' => ':attribute không được để trống!',
            '*.slug.required' => ':attribute không được để trống!',
            '*.slug.unique' => ':attribute đã tồn tại trong hệ thống',

        ];
    }
    public function attributes()
    {
        return [
            '*.name' => 'Tên',
            '*.slug' => 'URL',
        ];
    }
}
