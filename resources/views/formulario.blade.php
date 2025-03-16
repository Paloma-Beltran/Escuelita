<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiante</title>
</head>
<body>
    <h1>Formulario de Registro</h1>
    <form action="{{ route('estudiantes.index') }}" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label>Correo:</label>
        <input type="email" name="correo" required>
        <br>
        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" required>
        <br>
        <label>Ciudad:</label>
        <input type="text" name="ciudad" required>
        <br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
