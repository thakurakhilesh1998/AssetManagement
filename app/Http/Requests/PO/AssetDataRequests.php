<?php

namespace App\Http\Requests\PO;

use Illuminate\Foundation\Http\FormRequest;

class AssetDataRequests extends FormRequest
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
        $rules=[
            'blocklist' => 'required', 
            'gp'=>'nullable|string',
            'muncipal_area'=>'nullable|string',
            'nameofproperty' => 'required|min:4',
            'owner' => 'required',
            'type' => 'required',
            'area_type' => 'required',
            'use_of_building' => 'required',
            'otheruse'=>'nullable|string',
            'along_highway' => 'required',
            'area_land' => 'required|numeric',
            'areaofbuilding' => 'required|numeric',
            'gps' => 'required|regex:/^-?\d{2}\.\d{6},-?\d{2}\.\d{6}$/',
            'current_income' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'legal_dispute'=>'nullable|string',
            'jamabandi'=> ['file','mimes:pdf','max:1024'],
            'picture'=>['image','mimes:jpeg,jpg,png','max:1024'],
            'possibility_income' => 'required|min:2',
        ];
        return $rules;
    }
}
