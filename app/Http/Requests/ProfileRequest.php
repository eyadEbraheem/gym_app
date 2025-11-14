<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class ProfileRequest extends FormRequest
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
    $user=Auth::user();
    $isCoach=$user && $user->role==='مدرب';
    $rules= [
        'height' => 'required | integer |min:50 |max:300',
        'weight' => 'required |integer| min:20| max:500',
        'age' => 'required |integer| min:5|max:120',
        'goal' => 'required |string| max:255',
        'image' => 'required | image| mimes:jpeg,png,jpg,gif,svg| max:2048',
    ];
    if($isCoach){
        $rules['years_experiense']='required |integer| min:0| max:100';
        $rules['bio']='required | string| max:1000';
    }
    else{
        $rules['years_experiense']='nullable |integer| min:0| max:100';
        $rules['bio']='nullable | string| max:1000';
    }
    [
        'years_experiense.required'=>'هذا الحقل المطلوب',
        'bio.required'=>'هذا الحقل المطلوب',
    ];
    return $rules;
}
}
