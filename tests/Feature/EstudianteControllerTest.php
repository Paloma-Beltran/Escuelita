<?php

namespace Tests\Feature;

use App\Models\Estudiante;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstudianteControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function muestra_listado_alumnos()
    {
        $response = $this->get('/estudiantes');
        $response->assertSee('Lista de Estudiantes')
                 ->assertStatus(200);
    }

    /** @test */
    public function muestra_formulario_crear_alumno()
    {
        $response = $this->get('/estudiantes/create');

        // Depuración si falla la prueba
        if ($response->status() !== 200) {
            dump($response->content());
        }

        $response->assertSee('Formulario de Registro')
                 ->assertSee('name="nombre"', false) // ✅ Corregido aquí
                 ->assertStatus(200);
    }

    /** @test */
    public function muestra_formulario_editar_alumno()
    {
        $estudiante = Estudiante::factory()->create();

        $response = $this->get(route('estudiantes.edit', $estudiante));

        $response->assertSee('Editar Estudiante # ' . $estudiante->id)
                 ->assertSee($estudiante->nombre)
                 ->assertSee($estudiante->correo)
                 ->assertSee($estudiante->fecha_nacimiento)
                 ->assertSee($estudiante->ciudad)
                 ->assertStatus(200);
    }

    /** @test */
    public function muestra_detalles_alumno()
    {
        $estudiante = Estudiante::factory()->create();

        $response = $this->get(route('estudiantes.show', $estudiante));

        $response->assertSee('Estudiante # ' . $estudiante->id)
                 ->assertSee($estudiante->nombre)
                 ->assertSee($estudiante->correo)
                 ->assertSee($estudiante->fecha_nacimiento)
                 ->assertSee($estudiante->ciudad)
                 ->assertStatus(200);
    }

    /** @test */
    public function crear_alumno()
    {
        $estudiante = Estudiante::factory()->make();

        $response = $this->post('/estudiantes', $estudiante->toArray());

        $this->assertDatabaseHas('estudiantes', $estudiante->toArray());
        $response->assertRedirect(route('estudiantes.index'));
    }

    /** @test */
    public function editar_alumno()
    {
        $estudiante = Estudiante::factory()->create();

        $nuevosDatos = [
            'nombre' => 'Paloma',
            'correo' => 'Test@example.com',
            'fecha_nacimiento' => '2001-04-14',
            'ciudad' => 'Guadalajara',
        ];

        $response = $this->put(route('estudiantes.update', $estudiante->id), $nuevosDatos);

        $this->assertDatabaseHas('estudiantes', $nuevosDatos);
        $response->assertRedirect(route('estudiantes.show', $estudiante));
    }

    /** @test */
    public function eliminar_alumno()
    {
        $estudiante = Estudiante::factory()->create();

        $response = $this->delete(route('estudiantes.destroy', $estudiante->id));

        $this->assertDatabaseMissing('estudiantes', ['id' => $estudiante->id]);
        $response->assertRedirect(route('estudiantes.index'));
    }
}

