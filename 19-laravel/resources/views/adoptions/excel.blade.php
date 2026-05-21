<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adopciones - Larapets</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4a5568;
            color: white;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">LISTADO DE ADOPCIONES - LARAPETS</h2>
    <p style="text-align: center;">Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>FOTO</th>
                <th>ADOPTANTE</th>
                <th>DOCUMENTO</th>
                <th>EMAIL</th>
                <th>TELÉFONO</th>
                <th>FOTO</th>
                <th>MASCOTA</th>
                <th>TIPO</th>
                <th>RAZA</th>
                <th>FECHA ADOPCIÓN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adopts as $adopt)
            <tr>
                <td class="text-center">{{ $adopt->id }}</td>
                <td>{{ $adopt->user->fullname ?? 'N/A' }}</td>
                <td class="text-center">{{ $adopt->user->document ?? 'N/A' }}</td>
                <td>{{ $adopt->user->email ?? 'N/A' }}</td>
                <td>{{ $adopt->user->phone ?? 'N/A' }}</td>
                <td>{{ $adopt->pet->name ?? 'N/A' }}</td>
                <td>{{ $adopt->pet->kind ?? 'N/A' }}</td>
                <td>{{ $adopt->pet->breed ?? 'N/A' }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($adopt->created_at)->format('d/m/Y') }}</td>
            </tr>

            @endforeach
        </tbody>
    <p>Total de adopciones: {{ $adopts->count() }}</p>
</body>
</html>
