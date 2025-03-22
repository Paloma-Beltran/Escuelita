<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Estudiante</title>
</head>
<body>

    <h1>Editar Estudiante # {{ $estudiante->id }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('estudiantes.update', $estudiante) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre"  value="{{ $estudiante->nombre }}">
        @error('nombre')
            <div class="alert alert-danger">{{ $estudiante }}</div>
        @enderror
        <br>
        <label>Correo:</label>
        <input type="email" name="correo" value="{{ $estudiante->correo }}">
        @error('correo')
            <div class="alert alert-danger">{{ $estudiante }}</div>
        @enderror
        <br>
        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="{{ $estudiante->fecha_nacimiento }}">
        @error('fecha_nacimiento')
            <div class="alert alert-danger">{{ $estudiante }}</div>
        @enderror
        <br>
        <label>Ciudad:</label>
        <input type="text" name="ciudad" value="{{ $estudiante->ciudad }}">
        @error('ciudad')
            <div class="alert alert-danger">{{ $estudiante }}</div>
        @enderror
        <br>

        <button type="submit">Enviar</button>
    </form>

    <br>
    <!-- Botón Tabla Estudiantes -->
    <form action="{{ route('estudiantes.index', $estudiante) }}" method="GET" style="display:inline;">
        <button type="submit">Ver Tabla de Estudiantes</button>
    </form>

</body>
</html>

