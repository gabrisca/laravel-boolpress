<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // cambiare in true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255|min:3', // title deve avere un minimi di 3 caratteri e un massimo di 255
            'content' => 'required|min:3', // content deve avere almeno 3 caratteri
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ];
    }

    public function messages() // gestione errori
    {
        // customizzo i messaggi di errore
        return [
            'title.required' => 'Titolo è un campo obbligatorio',
            'title.max' => 'Sono consentiti al massimo :max caratteri',
            'title.min' => 'Devi inserire almeno :min caratteri',
            'content.required' => 'Contenuto è un campo obbligatorio',
            'content.min' => 'Devi inserire almeno :min caratteri',
            'category_id.exists' => 'La categoria scelta non è presente',
            'tags.exists' => 'Il tag scelto non è presente'
        ];
    }
}
