<?php

use App\Models\Estudiante;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('muestra-listado-alumnos', function () {
    $response = $this->get('/estudiantes');
    $response->assertSee('Lista de Estudiantes');

    $response->assertStatus(200);
});

test('muestra-formulario-crear-alumno', function () {
    $response = $this->get('/estudiantes/create');
    $response->assertSee('Formulario de Registro')
        ->assertSeeHtml('name="nombre"', false);

    $response->assertStatus(200);
});

test('muestra-formulario-editar-alumno', function () {
    $estudiante = Estudiante::factory()->create();

    $response = $this->get(route('estudiantes.edit', $estudiante->id));

    $response->assertSee('Editar Estudiante # ', $estudiante->id)
        ->assertSeeHtml($estudiante->nombre)
        ->assertSeeHtml($estudiante->correo)
        ->assertSeeHtml($estudiante->fecha_nacimiento)
        ->assertSeeHtml($estudiante->ciudad)
        ->assertStatus(200);
});

test('muestra-detalles-alumno', function () {
    $estudiante = Estudiante::factory()->create();

    $response = $this->get(route('estudiantes.show', $estudiante->id));

    $response->assertSee('Estudiante # ', $estudiante->id)
        ->assertSeeHtml($estudiante->nombre)
        ->assertSeeHtml($estudiante->correo)
        ->assertSeeHtml($estudiante->fecha_nacimiento)
        ->assertSeeHtml($estudiante->ciudad)
        ->assertStatus(200);
});

test('crear-alumno', function () {
    $estudiante = Estudiante::factory()->make();

    $response = $this->post('/estudiantes', $estudiante->toArray());

    $this->assertDatabaseHas('estudiantes', $estudiante->toArray());
    $response->assertRedirect('/estudiantes');
});

test('editar-alumno', function () {
    $estudiante = Estudiante::factory()->create();

    $nuevosDatos = [
        'nombre' => 'Rafael',
        'correo' => 'Test@example.com',
        'fecha_nacimiento' => '2001/04/14',
        'ciudad' => 'Guadalajara',
    ];

    $response = $this->put('/estudiantes/' . $estudiante->id, $nuevosDatos);

    $this->assertDatabaseHas('estudiantes', [
        'nombre' => 'Rafael',
        'correo' => 'Test@example.com',
        'fecha_nacimiento' => '2001/04/14',
        'ciudad' => 'Guadalajara',
    ]);

    $response->assertRedirect('/estudiantes/' . $estudiante->id);

    $estudiante->delete();
});

test('eliminar-alumno', function () {
    $estudiante = Estudiante::factory()->create();

    $response = $this->delete('/estudiantes/' . $estudiante->id);

    $this->assertDatabaseMissing('estudiantes', ['id' => $estudiante->id,]);
    $response->assertRedirect('/estudiantes');
});