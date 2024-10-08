<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FournisseurRequest extends FormRequest
{
    /*
     * Determine if the user is authorized to make this request.
     */

    public function authorize(): bool
    {
        return false;
    }

    /*
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'region' => 'required',
            'country' => 'required',
            'phone' => 'required|min:10|max:12',
            'country' => 'required',
            'phone' => 'required',
            'postCode' => 'required',
            'unspsc' => 'required',
        ];
    }

    public function messages()
    {
        return 
        [
            'nom.required' => 'Erreur nom',
        ];
    }
}
