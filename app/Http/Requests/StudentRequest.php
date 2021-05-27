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
     * @return array
     */
    public function rules()
    {
        return [
            'class_id'=>'bail|required',
            'email'=>'required|unique:students',
            'name'=> 'required',
            'dob'=> 'required|date',
            'password'=>'required|string|confirmed',
            'city'=> 'required',
            'country'=> 'required',
            'pincode'=> 'required|max:6|min:6',
            'mobile'=> 'required|max:10|min:10',
            'status'=> 'integer',
            'role'=> 'required',
            'gender'=> 'required',
            // 'about'=> 'string|max:255',
            //'profile' => 'required|image'    
            //Family Validation        
            'father_name'=>'required',
            'mother_name'=>'required',
            'f_mobile'=>'required',
            'm_mobile'=>'max:10|min:10',
            'parent_address'=>'required',
            'parent_city'=>'required',
            'parent_country'=>'required',
            'parent_pincode'=>'max:6|min:6',
        ];
    }
}
