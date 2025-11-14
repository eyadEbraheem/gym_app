<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required | string | max:100',
            'role'=>'required | in:مستخدم,مدرب',
            'email'=>'required | string | email |max:255 | unique:users,email',
            'password'=>'required | string | min:8 | confirmed',
        ];
        [        
            'name.required' => 'حقل الاسم مطلوب ',
            'name.string' => 'يجب كتابة الاسم بشكل صحيح',
            'name.max' => 'الاسم طويل',
            'email.email' => 'يجب ان يحتوي الايميل على @',
            'email.unique' => 'هذا الايميل موجود مسبقا',
            'email.required' =>'هذا الحقل مطلوب',
            'email.string' =>'يجب كتابة البريد بشكل صحيح',
            'password.required' =>'هذا الحقل مطلوب',
            'password.confirmed' =>'كلمتا المرور غير متطابقتين',
            'password.min' => 'يجب ان تحتوي كلمة المرور على 8 احرف على الاقل',
        
        ];
    }
}
