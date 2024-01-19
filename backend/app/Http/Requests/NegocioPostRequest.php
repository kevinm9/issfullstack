<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NegocioPostRequest extends FormRequest
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
            'nombrenegocio' => 'required',
            'industria_id' => 'required|numeric',
            'nombre' => 'required',
            'apellido' => 'required',
            'celular' => 'required',
            'correo' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'nombrenegocio.required' => 'El :attribute es requerido',
            'industria_id.required' => 'El :attribute es requerido',
        ];
    }

    public function attributes()
    {
        return [
            'nombrenegocio' => 'nombre del negocio',
            'industria_id' => 'tipo de industria',
        ];
    }


}
