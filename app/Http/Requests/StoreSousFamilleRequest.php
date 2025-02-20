<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSousFamilleRequest extends FormRequest
{
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
            'libelle' => 'required',
            'image' => 'required',
            'famille_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'libelle.required' => 'Le libelle est requise',
            'image.required' => 'L\'image est requise',
            'famille_id.required' => 'La famille est requise',
        ];
    }
}
