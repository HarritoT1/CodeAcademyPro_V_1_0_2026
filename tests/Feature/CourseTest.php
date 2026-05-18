<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Models\Course;
//use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

class CourseTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_incripcion_exitosa_a_un_curso (): void {
        $this->withoutMiddleware([
            VerifyCsrfToken::class,
            EnsureEmailIsVerified::class,
        ]);

        $user = User::factory()->create();

        $this->actingAs($user);

        $course = Course::factory()->create();

        $response = $this->from('/newcourses')->post('/newcourses/' . $course->id);

        $response->assertStatus(302)
            ->assertRedirect('/newcourses') // Valida que la ruta a la que redirige es la correcta.
            ->assertSessionHas('success', 'El usuario se ha inscrito en el curso: ' . $course->course_name . '.')
            ->assertSessionHasNoErrors(); // Asegura que no hay errores en la sesión.

        $this->assertDatabaseHas('registrations', [
            'user_id' => $user->id,
            'course_id' => $course->id
        ]);
    }

    public function test_registrar_progreso_tema () {
        $this->withoutMiddleware([
            VerifyCsrfToken::class,
            EnsureEmailIsVerified::class,
        ]);

        $user = User::factory()->create();

        $this->actingAs($user);

        $course = Course::all()->random();

        $topíc = $course->topics->random();

        // Inscribir al usuario en el curso.
        $user->courses()->syncWithoutDetaching([$course->id]);

        $this->assertDatabaseHas('registrations', [
            'user_id' => $user->id,
            'course_id' => $course->id
        ]);

        $response = $this->from('/course/' . $course->id . '?topic=' . $topíc->id)->post("/course/{$course->id}/advance", [
            'type' => 'Topic',
            'id' => $topíc->id
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => 'Avance registrado con exito del tema: ' . $topíc->title . '. Registrado: ' . $topíc->created_at->toDayDateTimeString() . '.']);

        $this->assertDatabaseHas('user_topic_progresses', [
            'user_id' => $user->id,
            'topic_id' => $topíc->id
        ]);
    }
}
