<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        // Sanitización previa.
        $request->merge([
            'name' => trim($request->input('name')),
            'password' => trim($request->input('password')),
            'remember_token' => boolval(trim($request->input('remember_token'))),
        ]);

        // Validación de los datos de entrada. 
        $credentials = $request->validate(
            [
                'name' => 'required|string|max:255',
                'password' => 'required|string|max:255',
                'remember_token' => 'sometimes|boolean',
            ],
            [
                'name.required' => 'El campo de nombre es obligatorio.',
                'name.string' => 'El nombre debe ser una cadena de texto.',
                'name.max' => 'El nombre no puede tener más de 255 caracteres.',
                'password.required' => 'El campo de contraseña es obligatorio.',
                'password.string' => 'La contraseña debe ser una cadena de texto.',
                'password.max' => 'La contraseña no puede tener más de 255 caracteres.',
                'remember_token.boolean' => 'El token de recordatorio debe ser verdadero o falso.',
            ]
        );

        $user_and_pass = [
            'name' => $credentials['name'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($user_and_pass, $credentials['remember_token'] ?? false)) {

            // Regenera la sesión para evitar la fijación de sesión.
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard')); // Redirige al panel de control después de un inicio de sesión exitoso.    
        }

        return back()->withErrors([
            'credenciales' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('name');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Has cerrado sesión exitosamente.');
    }
}
