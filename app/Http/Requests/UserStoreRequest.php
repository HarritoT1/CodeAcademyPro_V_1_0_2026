<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'password' => $this->emptyToNull($this->password),
            'confirm_password' => $this->emptyToNull($this->confirm_password),
            'email' => $this->emptyToNull($this->email),
            'rol_id' => $this->emptyToNull($this->rol_id),
            'phone_number' => $this->emptyToNull($this->phone_number),
            'home_address' => $this->emptyToNull($this->home_address),
            'description' => $this->emptyToNull($this->description),
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
            'fullname' => 'required|string|max:255|min:5',
            'name' => 'required|string|max:255|min:5|unique:users,name',
            'password' => 'required|string|min:8|max:30',
            'confirm_password' => 'required|string|min:8|max:30|same:password',
            'email' => 'required|string|email|max:255|unique:users,email',
            'rol_id' => 'required|integer|exists:roles,id',
            'phone_number' => 'required|string|max:20|regex:/^\d{2}-\d{4}-\d{4}$/|unique:users,phone_number',
            'home_address' => 'required|string|max:30000',
            'description' => 'required|string|max:30000',
            'avatar_url' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'El campo de nombre completo es obligatorio.',
            'fullname.string' => 'El nombre completo debe ser una cadena de texto.',
            'fullname.max' => 'El nombre completo no puede tener más de 255 caracteres.',
            'fullname.min' => 'El nombre completo debe tener al menos 5 caracteres.',
            'name.required' => 'El campo de nombre de usuario es obligatorio.',
            'name.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'name.max' => 'El nombre de usuario no puede tener más de 255 caracteres.',
            'name.min' => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'name.unique' => 'El nombre de usuario ya esta en uso.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 30 caracteres.',
            'confirm_password.required' => 'El campo de confirmación de contraseña es obligatorio.',
            'confirm_password.string' => 'La confirmación de contraseña debe ser una cadena de texto.',
            'confirm_password.min' => 'La confirmación de contraseña debe tener al menos 8 caracteres.',
            'confirm_password.max' => 'La confirmación de contraseña no puede tener más de 30 caracteres.',
            'confirm_password.same' => 'Las contraseñas no coinciden.',
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.string' => 'El correo electrónico debe ser una cadena de texto.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'email.unique' => 'El correo electrónico ya esta en uso.',
            'rol_id.required' => 'El campo de rol es obligatorio.',
            'rol_id.integer' => 'El rol debe ser un entero.',
            'rol_id.exists' => 'El rol especificado no existe.',
            'phone_number.required' => 'El campo de teléfono es obligatorio.',
            'phone_number.string' => 'El teléfono debe ser una cadena de texto.',
            'phone_number.max' => 'El teléfono no puede tener más de 20 caracteres.',
            'phone_number.regex' => 'El formato del teléfono no es correcto.',
            'phone_number.unique' => 'El teléfono ya esta en uso.',
            'home_address.required' => 'El campo de domicilio es obligatorio.',
            'home_address.string' => 'El domicilio debe ser una cadena de texto.',
            'home_address.max' => 'El domicilio no puede tener más de 30000 caracteres.',
            'description.required' => 'El campo de descripción es obligatorio.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede tener más de 30000 caracteres.',
            'avatar_url.file' => 'El archivo no es válido.',
            'avatar_url.image' => 'El archivo debe ser una imagen.',
            'avatar_url.mimes' => 'El archivo debe ser de tipo jpeg, png, jpg o gif.',
            'avatar_url.max' => 'El archivo no debe pesar más de 2MB.',
        ];
    }
}
