<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

/**
 * @extends Factory<Topic>
 */
class TopicFactory extends Factory
{
    protected $model = Topic::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->sentence(8),
            'content' => '<div class="text-break lh-base" style="text-align: justify; font-size: 1.1rem !important;" id="topic_content">
            <!-- Contenido del tema en html generado por RichTextEditor y almacenado en la columna content de la tabla. -->
            <p>
              La restricción CHECK se utiliza para limitar el rango de valores que se puede colocar en una columna. <br>
              <br>
              Si define una CHECK restricción en una columna, solo se permitirán ciertos valores para esa columna. <br>
              <br>
              Si define una CHECK restricción en una tabla, puede limitar los valores en ciertas columnas en función de
              los valores de otras columnas de la fila. <br> <br>

              Ejemplo en SQL Server / Oracle / MS Access: <br> <br>

            <pre>
                <code class="line-numbers language-sql">CREATE TABLE Empleados (
                    ID int PRIMARY KEY,
                    Nombre varchar(255) NOT NULL,
                    Edad int CHECK (Edad>=18)
                  );</code>
              </pre>
            </p>
          </div>',
          'course_id' => Course::query()->inRandomOrder()->value('id'),
        ];
    }
}
