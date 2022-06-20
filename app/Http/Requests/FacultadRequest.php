<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class FacultadRequest extends FormRequest
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
            'nombre_facultad'=>['required','string'],
            'cant_carreras'=>['required'],
            'id_universidad'=>['required','string']

        ];
    }

    protected function messages(): array
    {
        return [
            'nombre_facultad.required'=>'El  nombre_facultad es obligatoio',
            'cant_carreras.required'=>'la cantidad de carreras es obligatoria',
            'id_universidad.required'=>'El id universidad es obligatorio'
        ];
    }
}
