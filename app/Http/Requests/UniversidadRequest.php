<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class UniversidadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'nombre_universidad'=>[
                'required', 'unique:universidades', 'string',
            ],
            'rector'=>[
                'required',  'string',
            ]
        ];
    }
    protected function messages(): array
    {
        return [
            'nombre_universidad.required'=>'El nombre_universidad es obligatorio',
            'nombre_universidad.unique'=>'El nombre_universidad  ya ha sido registrado en el sistema',
            'rector.required'=>'El rector es obligatorio',

        ];
    }
}
