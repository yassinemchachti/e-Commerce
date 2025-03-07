<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommandeRequest extends FormRequest
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
            // The "id" is optional and should be an integer if present.
            'id'              => 'nullable|integer',
    
            // Payment mode must be selected and exist in the "mode_reglements" table.
            'paymentMode'     => 'required|exists:mode_reglements,id',
    
            /*
             * Either an existing client must be selected (client field)
             * or new client details must be provided.
             */
            'client'          => 'required_without_all:nameclient,emailclient,passwordclient|exists:users,id',
            // 'nameclient'      => 'required_without:client|string|max:255',
            // 'emailclient'     => 'required_without:client|email|max:255|unique:users,email',
            // 'passwordclient'  => 'required_without:client|min:8',
    
            // The date of the order must be provided and be a valid date.
            'date'            => 'required|date',
    
            // The order status must be selected and exist in the "etats" table.
            'etat_id'         => 'required|exists:etats,id',
    
            // The "regler" field must be either "non_regler" or "regler".
            'regler'          => 'required|in:non_regler,regler',
    
            /*
             * If you have dynamic product inputs (e.g. as an array),
             * you can add rules like:
             *
             * 'products'              => 'required|array|min:1',
             * 'products.*.article'    => 'required|string|max:255',
             * 'products.*.prix_ht'    => 'required|numeric|min:0',
             * 'products.*.quantite'   => 'required|integer|min:1',
             * 'products.*.total_ht'   => 'required|numeric|min:0',
             */
            // 'products'              => 'required|array|min:1',
            // 'products.*.product_id' => 'required|exists:products,id',
            // 'products.*.price'      => 'required|numeric|min:0',
            // 'products.*.quantity'   => 'required|integer|min:1',
            // 'products.*.row_total'  => 'required|numeric|min:0',
        ];
    }


    public function messages(): array
    {
        return [
            'id.integer' => 'L\'identifiant doit être un nombre entier.',
            'paymentMode.required' => 'Le mode de règlement est obligatoire.',
            'paymentMode.exists' => 'Le mode de règlement sélectionné est invalide.',
            'client.required_without_all' => 'Veuillez sélectionner un client existant ou saisir les informations d\'un nouveau client.',
            'client.exists' => 'Le client sélectionné est invalide.',
            'nameclient.required_without' => 'Le nom complet du client est requis.',
            'nameclient.string' => 'Le nom complet doit être une chaîne de caractères.',
            'nameclient.max' => 'Le nom complet ne doit pas dépasser 255 caractères.',
            'emailclient.required_without' => 'L\'adresse email du client est requise.',
            'emailclient.email' => 'L\'adresse email doit être valide.',
            'emailclient.max' => 'L\'adresse email ne doit pas dépasser 255 caractères.',
            'emailclient.unique' => 'Cette adresse email est déjà utilisée.',
            'passwordclient.required_without' => 'Le mot de passe est requis pour le nouveau client.',
            'passwordclient.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
            'date.required' => 'La date de commande est obligatoire.',
            'date.date' => 'La date de commande doit être une date valide.',
            'etat_id.required' => 'L\'état de la commande est obligatoire.',
            'etat_id.exists' => 'L\'état sélectionné est invalide.',
            'regler.required' => 'Veuillez indiquer si la commande est réglée.',
            'regler.in' => 'La valeur de "régler" doit être "non_regler" ou "regler".',
            'products.required' => 'Les articles sont obligatoires.',
            'products.array' => 'Les articles doivent être présentés sous forme de tableau.',
            'products.min' => 'Vous devez ajouter au moins un article.',
            'products.*.product_id.required' => 'L\'identifiant du produit est requis.',
            'products.*.product_id.exists' => 'Le produit sélectionné est invalide.',
            'products.*.price.required' => 'Le prix est requis.',
            'products.*.price.numeric' => 'Le prix doit être un nombre.',
            'products.*.price.min' => 'Le prix doit être supérieur ou égal à 0.',
            'products.*.quantity.required' => 'La quantité est requise.',
            'products.*.quantity.integer' => 'La quantité doit être un nombre entier.',
            'products.*.quantity.min' => 'La quantité doit être au moins 1.',
            'products.*.row_total.required' => 'Le total de la ligne est requis.',
            'products.*.row_total.numeric' => 'Le total de la ligne doit être un nombre.',
            'products.*.row_total.min' => 'Le total de la ligne doit être supérieur ou égal à 0.',
        ];
    }
    

    
}
