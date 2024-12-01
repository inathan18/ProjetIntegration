<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoriqueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'etat_demande' => 'required|string|max:255',
            'modifie_par' => 'required|string|email|max:255',
            'raison_refus' => 'nullable|string',
            'modifications' => 'nullable|json',
        ];
    }
}
