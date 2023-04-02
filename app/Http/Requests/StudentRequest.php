<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'stu_id' => [
                'nullable'
            ],
            'stu_name' => ['string','nullable'],
            'stu_name_latin' => ['string','required'],
            'stu_gender' => ['nullable'],
            'stu_dob' => ['nullable'],
            'stu_address' => ['string','nullable'],
            'stu_phone' => ['nullable'],
            'stu_email' => ['nullable'],
            'degrees_id' => ['nullable'],
            'shift_id' => ['nullable'],
            'batch_id' => ['nullable'],
        ];
        return $rules;
    }
}
