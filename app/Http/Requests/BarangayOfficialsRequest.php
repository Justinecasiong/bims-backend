<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangayOfficialsRequest extends FormRequest
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
            'chairmanship_id' => 'required',
            'position_id' => 'required',
            'fullname' => 'required',
            'term_start' => 'required',
            'term_end' => 'required',
            'status' => 'required',
        ];
    }
}
