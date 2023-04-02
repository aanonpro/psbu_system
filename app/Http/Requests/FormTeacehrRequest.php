<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormTeacehrRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'status' => [
                'nullable'
            ],
            'name_kh'=>[
                'required'
            ],
            'image' => [
                'nullable',
                'mimes:jpeg,png,jpg,gif,webp,svg|max:2048'
            ],
        ];
        return $rules;
    }
}
