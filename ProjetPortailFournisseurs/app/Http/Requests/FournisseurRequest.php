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
            'phone' => 'required',
            'postCode' => 'required',
            'website' => 'required',
            'personneContact' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return 
        [
            'nom.required' => 'Erreur nom',
            'address.required' => 'Erreur address',
            'phone.required' => 'Erreur phone',
            'postCode.required' => 'Erreur postCode',
            'website.required' => 'Erreur website',
            'email.required' => 'Erreur email',
            'personneContact.required' => 'Erreur personneContact',
            'password.required' => 'Erreur password',
        ];
    }
}
