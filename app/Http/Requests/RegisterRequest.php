<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    public function rules() 
    {
        return [
            //
            'email' => 'required|unique:users,email',
            'nombre' => 'required',
            'username' => 'required',
            'cedula' => 'required',
            'celular' => 'required',
            'genero' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'cedula.required' => 'Por favor, ingrese la cédula del usuario.',
            'cedula.unique' => 'La cédula proporcionada ya ha sido registrada en nuestro sistema.',
            'nombre.required' => 'Por favor, ingrese el nombre del usuario.',
            'username.required' => 'Por favor, ingrese un username.',
            'celular.required' => 'Por favor, ingrese un numero de telefono.',
            'apellido.required' => 'Por favor, ingrese el apellido del usuario.',
            'email.required' => 'Por favor, ingrese una dirección de correo electrónico válida.',
            'email.unique' => 'La dirección de correo electrónico proporcionada ya ha sido registrada en nuestro sistema.',
            'password.required' => 'Por favor, ingrese una contraseña segura.',
            'password.min' => 'La contraseña debe contener al menos :min caracteres.',
            'password_confirmation.required' => 'Por favor, confirme la contraseña ingresada.',
            'password_confirmation.same' => 'Las contraseñas ingresadas no coinciden.'
        ];
    }
}
