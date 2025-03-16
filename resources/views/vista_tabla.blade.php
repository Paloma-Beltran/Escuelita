<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
</head>
<body>
    <h2>Lista de Estudiantes</h2>

    @if(session('success'))
    <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    @if($estudiantes->isEmpty())
        <p>No hay estudiantes registrados.</p>
    @else
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Fecha de Nacimiento</th>
                <th>Ciudad</th>
                <th>Acciones</th>
            </tr>
            @foreach ($estudiantes as $estudiante)
            <tr>
                <td>{{ $estudiante->id }}</td>
                <td>{{ $estudiante->nombre }}</td>
                <td>{{ $estudiante->correo }}</td>
                <td>{{ $estudiante->fecha_nacimiento }}</td>
                <td>{{ $estudiante->ciudad }}</td>
                <td>
                    <!-- Botón Ver -->
                    <form action="{{ route('estudiantes.show', $estudiante->id) }}" method="GET" style="display:inline;">
                        <button type="submit">Ver</button>
                    </form>
                    <!-- Botón Editar -->
                    <form action="{{ route('estudiantes.edit', $estudiante) }}" method="GET" style="display:inline;">
                        <button type="submit">Editar</button>
                    </form>
                    <!-- Botón Eliminar -->
                    <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    @endif

    <br>
    <!-- Botón Agregar Estudiante -->
    <form action="{{ route('estudiantes.create', $estudiante) }}" method="GET" style="display:inline;">
        <button type="submit">Agregar Nuevo Estudiante</button>
    </form>

</body>
</html>