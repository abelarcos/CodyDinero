<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;//uso del facade Auth para verificar si el usuario esta logueado
use Illuminate\Validation\Rule;//importo el Rule



class StoreMovement extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //el type que sea requerido y 
            //y con rule le indico si es ingreso o egreso una de las dos
            'type' => [ 
                'required', 
                Rule::in(['egreso', 'ingreso'])  
            ],

            'movement_date' => 'required|date',
            'category_id' => 'required',
            'description' => 'required|min:3|max:1000',
            'money' => 'required|numeric|min:0.01',
            'image' => 'image'
            
        ];
    }

    public function messages(){
        return [
            'type.required' => 'El campo tipo es requerido',
            'type.in' => 'El valor del campo tipo no es valido',
            'movement_date.required' => 'El campo fecha es requerido',
            'movement_date.date' => 'La fecha no es valida',
            'category_id.required' => 'La categoria es obligatoria',
            'description.required' => 'La descripcion es obligatoria',
            'description.min' => 'La descripcion debe tener tres caracteres o mas',
            'description.max' => 'La descripcion no puede tener mas de 1000 caracteres',
            'money.required' => 'El monto es obligatorio',
            'money.numeric' => 'El monto debe ser un numero',
            'money.min' => 'El monto debe ser mayor a cero',
            'image.image' => 'El archivo Adjunto no es una imagen valida'
        ];

    }
}
