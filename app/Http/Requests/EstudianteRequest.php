<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class EstudianteRequest extends FormRequest
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
            'nombres'=>[
                'required','string'
            ],
            'apellidos'=>[
                'required','string'
            ],
            'correo'=>[
                'required','email'
            ],
            'usuario'=>[
                'required','unique:estudiantes'
            ],
            'edad'=>[
                'required'
            ],
            'id_facultad'=>[
                'required'
            ]
        ];
    }

    protected function messages(): array
    {
        return [
            'nombres.required'=>'Los nombres es obligatorio',
            'apellidos.required'=>'Los apellidos son obligatorios',
            'correo.required'=>'El correo es obligatorio',
            'correo.email'=>'El correo no posee un formato valido',
            'usuario.required'=>'El nombre de usuario es requerido',
            'usuario.unique'=>'El nombre de usuario ya se encuentra registrado ',
            'edad.required'=> 'La edad es  obligatoria',
            'id_facultad.required'=>'El id de la facultad es obligatorio',
        ];
    }

}
