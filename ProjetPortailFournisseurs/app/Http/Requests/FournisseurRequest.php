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
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'address' => 'required',
            'postCode' => 'required',
            'website' => 'required',
            'personneContact' => 'required',
            'phone' => 'required',
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
            'website.required' => 'Erreur website',
            'email.required' => 'Erreur email',
            'personneContact.required' => 'Erreur personneContact',
            'password.required' => 'Erreur password',
        ];
    }
}
