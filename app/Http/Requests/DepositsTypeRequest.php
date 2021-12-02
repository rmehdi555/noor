<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositsTypeRequest extends FormRequest
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
        $allLang=\App\Providers\MyProvider::get_languages_array();
        $result=[];

        if($this->method() == 'POST') {

            $result=array_merge($result , [
                'type'=>'required',
                'title'=>'required',
            ]);
            return $result;
        }

        $result=array_merge($result , [
            'type'=>'required',
            'title'=>'required',
        ]);
        return $result;
    }
}
