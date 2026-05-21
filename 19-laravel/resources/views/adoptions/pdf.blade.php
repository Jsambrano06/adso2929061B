<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Adopciones - Larapets</title>
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

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4a5568;
        }

        .header h1 {
            color: #2d3748;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header .date {
            color: #718096;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11px;
        }

        th {
            background-color: #2d3748;
            color: white;
            padding: 10px 8px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #4a5568;
        }

        td {
            padding: 8px 6px;
            border: 1px solid #cbd5e0;
            vertical-align: middle;
        }

        tr:nth-child(even) {
            background-color: #f7fafc;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        .photo {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>🐾 REPORTE DE ADOPCIONES - LARAPETS</h1>
        <div class="date">Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</div>
    </div>

    <table cellspacing="0">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="8%">FOTO</th>
                <th width="12%">ADOPTANTE</th>
                <th width="10%">DOCUMENTO</th>
                <th width="8%">FOTO</th>
                <th width="12%">MASCOTA</th>
                <th width="8%">TIPO</th>
                <th width="10%">RAZA</th>
                <th width="10%">FECHA ADOPCIÓN</th>
                <th width="8%">ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @forelse($adopts as $adopt)
            <tr>
                <td class="text-center">{{ $adopt->id }}</td>
                <td class="text-center">
                    @php
                        $userPhoto = public_path('images/' . ($adopt->user->photo ?? 'no-photo.png'));
                        $noPhoto = public_path('images/no-photo.png');
                        $validPhoto = file_exists($userPhoto) && $adopt->user->photo && $adopt->user->photo != 'no-photo.png';
                    @endphp
                    @if($validPhoto)
                        <img src="{{ $userPhoto }}" class="photo" alt="Foto {{ $adopt->user->fullname }}">
                    @else
                        <img src="{{ $noPhoto }}" class="photo" alt="Sin foto">
                    @endif
                </td>
                <td class="font-bold">{{ $adopt->user->fullname ?? 'N/A' }}</td>
                <td class="text-center">{{ number_format($adopt->user->document ?? 0, 0, '', '.') }}</td>
                <td class="text-center">
                    @php
                        $petPhoto = public_path('images/pets/' . ($adopt->pet->image ?? 'no-photo.png'));
                        $noPetPhoto = public_path('images/pets/no-photo.png');
                        $validPetPhoto = file_exists($petPhoto) && $adopt->pet->image && $adopt->pet->image != 'no-photo.png';
                    @endphp
                    @if($validPetPhoto)
                        <img src="{{ $petPhoto }}" class="photo" alt="Foto {{ $adopt->pet->name }}">
                    @else
                        <img src="{{ $noPetPhoto }}" class="photo" alt="Sin foto">
                    @endif
                </td>
                <td class="font-bold">{{ $adopt->pet->name ?? 'N/A' }}</td>
                <td class="text-center">{{ $adopt->pet->kind ?? 'N/A' }}</td>
                <td class="text-center">{{ $adopt->pet->breed ?? 'N/A' }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($adopt->created_at)->format('d/m/Y') }}</td>
                <td class="text-center">
                    <span style="background-color: #48bb78; color: white; padding: 3px 8px; border-radius: 12px; font-size: 10px;">COMPLETADA</span>
                </td>

            @empty
            <tr>
                <td colspan="10" class="text-center">No hay adopciones registradas<\/td>

            @endforelse
        </tbody>

    <div class="footer">
        Total de adopciones: {{ $adopts->count() }}
    </div>
</body>
</html>
