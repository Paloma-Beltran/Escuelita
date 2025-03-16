<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informacion de Estudiante</title>
</head>
<body>

    @if(session('success'))
    <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <h1>Estudiante # {{$estudiante->id}}</h1>
    <ul>
        <li>Nombre: {{$estudiante->nombre}}</li>
        <li>Correo: {{$estudiante->correo}}</li>
        <li>Fecha de Nacimiento: {{$estudiante->fecha_nacimiento }}</li>
        <li>Ciudad: {{$estudiante->ciudad}}</li>
    </ul>

    <br>
    <!-- Botón Tabla Estudiantes -->
    <form action="{{ route('estudiantes.edit', $estudiante) }}" method="GET" style="display:inline;">
        <button type="submit">Editar Informacion de Estudiante</button>
    </form>

    <br>
    <br>
    <!-- Botón Agregar Estudiante -->
    <form action="{{ route('estudiantes.index', $estudiante) }}" method="GET" style="display:inline;">
        <button type="submit">Ver Tabla de Estudiantes</button>
    </form>

    <br>
    <br>
    <!-- Boton Eliminar Estudiante -->
    <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
            Eliminar
        </button>
    </form>

</body>
</html>