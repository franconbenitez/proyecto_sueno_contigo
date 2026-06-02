<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|max:150',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
    
    public function messages(): array
    {
        return [
            'nombre.required' => 'Debe ingresar un nombre.',
            'precio.required' => 'Debe ingresar un precio.',
            'stock.required' => 'Debe ingresar un stock.',
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'imagen.required' => 'Debe seleccionar una imagen.',
        ];
    }
}