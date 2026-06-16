<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta petición.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            // El regex asegura que solo haya letras (a-z, A-Z), acentos y espacios
            'nombre'   => ['required', 'string', 'max:100', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'apellido' => ['required', 'string', 'max:100', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'email'    => 'required|email|unique:personas,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'nombre.required'   => 'El nombre es obligatorio.',
            'nombre.regex'      => 'El nombre no puede contener números ni caracteres especiales.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.regex'    => 'El apellido no puede contener números ni caracteres especiales.',
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'El formato del correo no es válido.',
            'email.unique'      => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed'=> 'Las contraseñas no coinciden.',
        ];
    }
}