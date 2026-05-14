<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'fullname' => $this->emptyToNull($this->fullname),
            'name' => $this->emptyToNull($this->name),
            'rol_id' => $this->emptyToNull($this->rol_id),
            'phone_number' => $this->emptyToNull($this->phone_number),
            'home_address' => $this->emptyToNull($this->home_address),
            'description' => $this->emptyToNull($this->description),
            'preview' => $this->emptyToNull($this->preview), 
            'google_id' => $this->emptyToNull($this->google_id),
        ]);
    }

    /**
     * Convierte cadenas vacías a null.
     */
    private function emptyToNull(?string $value): ?string
    {
        $value = trim($value ?? '');
        return $value === '' ? null : $value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required_without:google_id|nullable|string|max:255|min:5',
            'name' => 'required|string|max:255|min:5|unique:users,name,' . Auth::id(),
            'rol_id' => 'required_without:google_id|nullable|integer|exists:roles,id',
            'phone_number' => 'required_without:google_id|nullable|string|max:20|regex:/^\d{2}-\d{4}-\d{4}$/|unique:users,phone_number,' . Auth::id(),
            'home_address' => 'required_without:google_id|nullable|string|max:30000',
            'description' => 'required_without:google_id|nullable|string|max:30000',
            'preview' => 'nullable|string|max:255',
            'avatar_url' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:3048',
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'El campo de nombre completo es obligatorio.',
            'fullname.string' => 'El nombre completo debe ser una cadena de texto.',
            'fullname.max' => 'El nombre completo no puede tener más de 255 caracteres.',
            'fullname.min' => 'El nombre completo debe tener al menos 5 caracteres.',

            'name.required' => 'El campo de nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'name.min' => 'El nombre debe tener al menos 5 caracteres.',
            'name.unique' => 'El nombre de usuario ya está en uso.',

            'rol_id.required' => 'El campo de rol es obligatorio.',
            'rol_id.integer' => 'El rol debe ser un entero.',
            'rol_id.exists' => 'El rol especificado no existe.',

            'phone_number.required' => 'El campo de número de teléfono es obligatorio.',
            'phone_number.string' => 'El número de teléfono debe ser una cadena de texto.',
            'phone_number.max' => 'El número de teléfono no puede tener más de 20 caracteres.',
            'phone_number.regex' => 'El número de teléfono debe tener el formato ###-####-####.',
            'phone_number.unique' => 'El número de teléfono ya está en uso.',

            'home_address.required' => 'El campo de dirección de casa es obligatorio.',
            'home_address.string' => 'La dirección de casa debe ser una cadena de texto.',
            'home_address.max' => 'La dirección de casa no puede tener más de 30000 caracteres.',

            'description.required' => 'El campo de descripción es obligatorio.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede tener más de 30000 caracteres.',

            'avatar_url.file' => 'El archivo debe ser válido.',
            'avatar_url.image' => 'El archivo debe ser una imagen.',
            'avatar_url.mimes' => 'El archivo debe ser de tipo JPEG, PNG, JPG o GIF.',
            'avatar_url.max' => 'El archivo debe tener un peso de 2MB o menos.',
            'avatar_url.uploaded' => 'Hubo un error al subir el archivo. Verifica el tamaño y el tipo de archivo.',
        ];
    }
}
