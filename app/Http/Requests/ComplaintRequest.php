<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
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

        if($this->method() == 'POST') {
            return [
                'name' => 'required|max:191',
                'family' => 'required|max:191',
                'phone' => ['required', 'numeric', 'digits:11'],
                'email' => ['nullable', 'string', 'email', 'max:255'],
                'body' => 'required',
            ];
        }

        return [
            'name' => 'required|max:191',
            'family' => 'required|max:191',
            'phone' => ['required', 'numeric', 'digits:11'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'body' => 'required',
        ];

    }
}
