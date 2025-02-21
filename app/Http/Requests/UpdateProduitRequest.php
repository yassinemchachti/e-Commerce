<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduitRequest extends FormRequest
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
            'codebar' => 'required',
            'tva' => 'required',
            'prix_ht' => 'required',
            'description' => 'required',
            'image' => 'required',
            'sous_famille' => 'required',
            'marque' => 'required',
            'unite' => 'required',
            'designation' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'codebar.required' => 'Le code barre est obligatoire.',
            'tva.required' => 'La TVA est obligatoire.',
            'prix_ht.required' => 'Le prix HT est obligatoire.',
            'designation.required' => 'La désignation est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'image.required' => 'L\'image est obligatoire.',
            'sous_famille.required' => 'La sous famille est obligatoire.',
            'marque.required' => 'La marque est obligatoire.',
            'unite.required' => 'L\'unité est obligatoire.',
        ];
    }
}
