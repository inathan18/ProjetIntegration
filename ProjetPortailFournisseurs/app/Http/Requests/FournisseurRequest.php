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
        return true;
    }

    /*
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'address' => 'required',
            'postCode' => 'required', 'regex: /^[A-Za-z]\d[A-Za-z] ?\d[A-Za-z]\d$',
            'website' => 'required',
            'personneContact' => 'required',
            'phone' => 'required', 'regex: /^\d{3}-\d{3}-\d{4}$/',
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return 
        [
            'name.required' => 'Erreur nom',
            'address.required' => 'Erreur address',
            'postCode.required' => 'Erreur postCode',
            'phone.required' => 'le numero de Téléphone est requis',
            'phone.regex' => 'le numero de Téléphone doit être dans ce format: 123-456-7890.',
            'website.required' => 'Erreur website',
            'email.required' => 'Erreur email',
            'personneContact.required' => 'Erreur personneContact',
            'password.required' => 'Erreur password',
        ];
    }
}
