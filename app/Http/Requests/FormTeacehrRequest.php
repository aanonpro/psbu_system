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
            'teacher_id' => [
                'required',
                'integer'
            ],
            'position_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'required'
            ],
            'image' => [
                'nullable',
                'mimes:jpeg,jpg,png'
            ],
        ];
        return $rules;
    }
}
