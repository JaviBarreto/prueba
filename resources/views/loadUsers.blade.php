<!-- vista.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Archivo Excel</title>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Pass</th>
            <th>Migrado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->nombre }}</td>
            <td>{{ $usuario->apellido }}</td>
            <td>{{ $usuario->pass }}</td>
            <td>{{ $usuario->migrado }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</table>
    

</body>
</html>
