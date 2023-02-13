<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CovidRequest extends FormRequest
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
            'resident_id' => 'required',
            'vaccination_type' => 'required',
            'dose_num' => 'required',
            'booster_type' => 'required',
            'reason' => 'required',
        ];
    }
}
