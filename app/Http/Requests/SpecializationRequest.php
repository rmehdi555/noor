<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecializationRequest extends FormRequest
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
        foreach ($allLang as $kay => $value)
        {
            $result=array_merge($result , [ 'title_'.$kay => 'required|max:250']);
            $result=array_merge($result , [ 'description_'.$kay => 'required']);
        }

        if($this->method() == 'POST') {

            $result=array_merge($result , [
                'price'=>'required|integer',
                'status'=>'required|integer',
                'priority'=>'required|integer',
            ]);
            return $result;
        }

        $result=array_merge($result , [
            'price'=>'required|integer',
            'status'=>'required|integer',
            'priority'=>'required|integer',
        ]);
        return $result;
    }
}
