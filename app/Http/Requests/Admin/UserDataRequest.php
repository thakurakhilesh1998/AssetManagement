<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserDataRequest extends FormRequest
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
        $roles=['admin','po','dpo','PRTI'];
        $district=['Bilaspur','Chamba','Hamirpur','Kangra','Kinnaur','Kullu','Lahul And Spiti','Mandi','Shimla','Sirmaur','Solan','Una'];
        $rules=[
            'username'=>['required','string'],
            'email'=>['required','email'],
            'password'=>['required','string','min:8','confirmed'],
            'role'=>['required','string','in:' . implode(',', $roles)],
            'district'=>['required','string','in:'.implode(',',$district)],
        ];
        return $rules;
    }
}
