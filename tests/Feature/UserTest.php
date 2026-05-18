<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
//use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    public function test_creacion_de_usuario (): void
    {   
        // Apagar middlewares para token csrf.
        $this->withoutMiddleware(VerifyCsrfToken::class);

        //dd(config('database.connections.mysql.database'));
        $user_data =[
            'fullname' => 'Test User',
            'name' => 'testuser',
            'password' => '12345678',
            'confirm_password' => '12345678',
            'email' => 'test_user@example.com',
            'rol_id' => 1,
            'phone_number' => '11-1111-1111',
            'home_address' => 'Calle 1',
            'description' => 'Descripción del test user',
        ];

        $response = $this->from('/usernew')->post('/usernew', $user_data);

        $user = User::latest()->first();

        $this->assertNotNull($user);

        //dd($user);

        $last_id_user_created = $user->id;

        $response->assertStatus(302)
            ->assertRedirect('/usernew/' . $last_id_user_created) // Valida que la ruta a la que redirige es la correcta.
            ->assertSessionHas('success', 'El usuario se ha creado exitosamente.')
            ->assertSessionHasNoErrors(); // Asegura que no hay errores en la sesión.

        // Seguir la redirección y validar la vista.
        $follow = $this->get('/usernew/' . $last_id_user_created);
        
        $follow->assertOk()
            ->assertViewIs('usernew')
            ->assertViewHas('user', function ($user) use ($last_id_user_created) {
                return $user->id == $last_id_user_created;
            })
            ->assertSee("Te hemos enviado un correo con un enlace")
            ->assertSee($user_data['email']);

        $this->assertDatabaseHas('users', [
            'id' => $last_id_user_created,
            'fullname' => $user_data['fullname'],
            'name' => $user_data['name'],
            'email' => $user_data['email'],
            'rol_id' => $user_data['rol_id'],
            'phone_number' => $user_data['phone_number'],
            'home_address' => $user_data['home_address'],
            'description' => $user_data['description'],
        ]);
    }

    public function test_actualizacion_de_usuario (): void
    {
        // Apagar middlewares para token csrf.
        $this->withoutMiddleware([
            VerifyCsrfToken::class,
            EnsureEmailIsVerified::class,
        ]);

        //dd(config('database.connections.mysql.database'));
        // Usuario con google_id en null.
        $user = User::create([
            'fullname' => 'Test User',
            'name' => 'testuser',
            'password' => Hash::make('Password'),
            'email' => 'user@example',
            'rol_id' => 1,
            'phone_number' => '11-1111-1111',
            'home_address' => 'Calle 1',
            'description' => 'Descripción del test user',
        ]);

        // Como es una ruta protegida, se necesita iniciar sesión.
        $this->actingAs($user); // Simula que la sesión esta autenticada.

        // Solo atualizaremos el fullname.
        $data_new = [
            'fullname' => "Test User modified",
            'name' => $user->name,
            'rol_id' => $user->rol_id,
            'phone_number' => $user->phone_number,
            'home_address' => $user->home_address,
            'description' => $user->description,
        ];

        $response = $this->from('/user/' . $user->id)->put('/user', $data_new);

        $response->assertStatus(302)
            ->assertRedirect('/user/' . $user->id) // Valida que la ruta a la que redirige es la correcta.
            ->assertSessionHas('success', 'El usuario se ha actualizado exitosamente.')
            ->assertSessionHasNoErrors(); // Asegura que no hay errores en la sesión.
        
        // Seguir la redirección y validar la vista.
        $follow = $this->get('/user/' . $user->id);

        $auth_user = $user;
        
        $follow->assertOk()
            ->assertViewIs('userpages.user')
            ->assertViewHas('user', function ($user) use ($auth_user) {
                return $user->id == $auth_user->id;
            })
            ->assertViewHas('editable', function ($editable) {
                return $editable == true;
            })
            ->assertSee("Este es tu perfil {$auth_user->name}");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'fullname' => $data_new['fullname'],
            'name' => $user->name,
            'email' => $user->email,
            'rol_id' => $user->rol_id,
            'phone_number' => $user->phone_number,
            'home_address' => $user->home_address,
            'description' => $user->description,
        ]);
    }
}
