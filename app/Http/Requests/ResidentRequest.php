<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidentRequest extends FormRequest
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
        return [
            'zone_id' => 'required',
            'first_name' => 'required',
            'middle_name' => 'string|nullable',
            'last_name' => 'required',
            'alias' => 'string|nullable',
            'place_of_birth' => 'required',
            'age' => 'required',
            'civil_status' => 'required',
            'birthdate' => 'required',
            'sex' => 'required',
            'voter_status' => 'required',
            'identified_as' => 'required',
            'email' => 'nullable|email',
            'contact_num' => 'required',
            'occupation' => 'nullable',
            'pwd_status' => 'required',
            'address' => 'required',
            'profile_pic' => 'nullable',
        ];
    }
}
