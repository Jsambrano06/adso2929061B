<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Mascotas - Larapets</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            font-size: 12px;
            padding: 20px;
            background: #fff;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        th {
            background-color: #2d3748;
            color: white;
            padding: 10px 8px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #4a5568;
            font-size: 12px;
        }

        td {
            padding: 8px 6px;
            border: 1px solid #cbd5e0;
            vertical-align: middle;
            font-size: 11px;
        }

        tr:nth-child(even) {
            background-color: #f7fafc;
        }

        tr:hover {
            background-color: #edf2f7;
        }

        .pet-photo {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto;
        }

        .no-photo {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: block;
            margin: 0 auto;
        }

        .status-adopted {
            color: #48bb78;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 4px;
            background: #f0fff4;
        }

        .status-available {
            color: #f56565;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 4px;
            background: #fff5f5;
        }

        .status-active {
            background-color: #48bb78;
            color: white;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .status-inactive {
            background-color: #a0aec0;
            color: white;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        @page {
            margin: 15mm;
            size: landscape;
        }

        @media print {
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="8%">FOTO</th>
                <th width="12%">NOMBRE</th>
                <th width="10%">TIPO</th>
                <th width="12%">RAZA</th>
                <th width="8%">PESO</th>
                <th width="6%">EDAD</th>
                <th width="12%">UBICACIÓN</th>
                <th width="10%">ADOPCIÓN</th>
                <th width="10%">ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pets as $pet)
            <tr>
                <td class="text-center">{{ $pet->id }}</td>

                <td class="text-center">
                    @php
                        $imagePath = public_path('images/pets/' . $pet->image);
                        $noPhotoPath = public_path('images/no-photo.png');
                        $isValidImage = false;

                        if($pet->image && $pet->image != '') {
                            $extension = strtolower(pathinfo($pet->image, PATHINFO_EXTENSION));
                            if(in_array($extension, ['jpg','jpeg','png','gif']) && file_exists($imagePath)) {
                                $isValidImage = true;
                            }
                        }
                    @endphp

                    @if($isValidImage)
                        <img src="{{ $imagePath }}" class="pet-photo">
                    @else
                        <img src="{{ $noPhotoPath }}" class="no-photo">
                    @endif
                </td>

                <td class="font-bold">{{ strtoupper($pet->name) }}</td>
                <td class="text-center">{{ ucfirst($pet->kind) }}</td>
                <td>{{ $pet->breed }}</td>
                <td class="text-center">{{ $pet->weight }} kg</td>
                <td class="text-center">{{ $pet->age }} años</td>
                <td>{{ $pet->location }}</td>

                <td class="text-center">
                    @if($pet->adopted)
                        <span class="status-adopted">ADOPTADO</span>
                    @else
                        <span class="status-available">DISPONIBLE</span>
                    @endif
                </td>

                <td class="text-center">
                    @if($pet->active)
                        <span class="status-active">ACTIVO</span>
                    @else
                        <span class="status-inactive">INACTIVO</span>
                    @endif
                </td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>

</body>
</html>