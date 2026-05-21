<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            object-fit: cover;
            display: block;
            margin: 0 auto;
        }

        .status-available {
            color: #48bb78;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            background: #f0fff4;
        }

        .status-adopted {
            color: #4299e1;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            background: #ebf8ff;
        }

        .status-inactive {
            color: #f56565;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            background: #fff5f5;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .font-bold {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            font-size: 10px;
            color: #a0aec0;
        }

        @page {
            margin: 15mm;
            size: landscape;
        }

        @media print {
            body {
                padding: 0;
            }
            .no-break {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <table cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="8%">FOTO</th>
                <th width="12%">NOMBRE</th>
<<<<<<< HEAD
                <th width="10%">TIPO</th>
                <th width="8%">PESO</th>
=======
                <th width="8%">TIPO</th>
                <th width="6%">PESO</th>
>>>>>>> bf55a9d (middleware)
                <th width="6%">EDAD</th>
                <th width="12%">RAZA</th>
                <th width="12%">UBICACIÓN</th>
                <th width="15%">DESCRIPCIÓN</th>
                <th width="8%">ESTADO</th>
<<<<<<< HEAD
=======
                <th width="8%">CREADO</th>
>>>>>>> bf55a9d (middleware)
            </tr>
        </thead>
        <tbody>
            @forelse($pets as $pet)
            <tr>
<<<<<<< HEAD
                <td class="text-center">{{ $pet->id }}</td>
=======
                <td class="text-center">{{ $pet->id }}
>>>>>>> bf55a9d (middleware)
                <td class="text-center">
                    @php
                        $imagePath = public_path('images/pets/' . $pet->image);
                        $noImagePath = public_path('images/pets/no-photo.png');
                        $isValidImage = false;

                        if($pet->image && $pet->image != 'no-photo.png' && $pet->image != '') {
                            $imageExtension = strtolower(pathinfo($pet->image, PATHINFO_EXTENSION));
                            if(in_array($imageExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp']) && file_exists($imagePath)) {
                                $isValidImage = true;
                            }
                        }
                    @endphp

                    @if($isValidImage)
                        <img src="{{ $imagePath }}" class="pet-photo" alt="Foto {{ $pet->name }}">
                    @else
                        <img src="{{ $noImagePath }}" class="no-photo" alt="Sin foto">
                    @endif
                </td>
<<<<<<< HEAD
                <td class="font-bold">{{ strtoupper($pet->name) }}</td>
                <td class="text-center">{{ $pet->kind }}</td>
                <td class="text-center">{{ number_format($pet->weight, 2) }} kg<\/td>
=======
                <td class="font-bold">{{ strtoupper($pet->name) }}
                <td class="text-center">{{ $pet->kind }}
                <td class="text-center">{{ number_format($pet->weight, 2) }} kg
>>>>>>> bf55a9d (middleware)
                <td class="text-center">
                    @if($pet->age < 1)
                        {{ $pet->age * 12 }} meses
                    @else
                        {{ number_format($pet->age, 1) }} años
                    @endif
<<<<<<< HEAD
                <\/td>
                <td class="text-center">{{ $pet->breed ?: 'No especificada' }}<\/td>
                <td class="text-center">{{ $pet->location ?: 'No especificada' }}<\/td>
                <td style="font-size: 10px;">{{ Str::limit($pet->description, 50) }}<\/td>
=======
                <td class="text-center">{{ $pet->breed ?: 'No especificada' }}
                <td class="text-center">{{ $pet->location ?: 'No especificada' }}
                <td style="font-size: 10px;">{{ Str::limit($pet->description, 50) }}
>>>>>>> bf55a9d (middleware)
                <td class="text-center">
                    @if($pet->adopted)
                        <span class="status-adopted">ADOPTADO</span>
                    @elseif($pet->active)
                        <span class="status-available">DISPONIBLE</span>
                    @else
                        <span class="status-inactive">INACTIVO</span>
                    @endif
<<<<<<< HEAD
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">No hay mascotas registradas<\/td>
=======

                <td class="text-center">{{ $pet->created_at ? $pet->created_at->format('d/m/Y') : 'N/A' }}
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">No hay mascotas registradas
>>>>>>> bf55a9d (middleware)
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
<<<<<<< HEAD
        Total de mascotas: {{ $pets->count() }}
=======
        Total de mascotas: {{ $pets->count() }} |
        Generado: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
>>>>>>> bf55a9d (middleware)
    </div>
</body>
</html>
