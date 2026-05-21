<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mascotas - Larapets</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            padding: 20px;
        }
        
        h2 {
            text-align: center;
            color: #2d3748;
            margin-bottom: 10px;
        }
        
        .subtitle {
            text-align: center;
            color: #718096;
            margin-bottom: 20px;
            font-size: 12px;
        }
        
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
            text-align: center;
        }
        
        td {
            vertical-align: top;
        }
        
        .text-center {
            text-align: center;
        }
        
        .status-available {
            background-color: #c6f6d5;
            color: #22543d;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }
        
        .status-adopted {
            background-color: #bee3f8;
            color: #2c5282;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }
        
        .stats {
            margin: 20px 0;
            padding: 10px;
            background-color: #f7fafc;
            border-radius: 8px;
            text-align: center;
        }
        
        .stats span {
            margin: 0 15px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h2> LISTADO DE MASCOTAS - LARAPETS</h2>
    <div class="subtitle">Reporte generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</div>
    
    <div class="stats">
        <span> Total: {{ $pets->count() }}</span>
        <span> Perros: {{ $pets->where('kind', 'Perro')->count() }}</span>
        <span> Gatos: {{ $pets->where('kind', 'Gato')->count() }}</span>
        <span> Disponibles: {{ $pets->where('active', 1)->where('adopted', 0)->count() }}</span>
        <span> Adoptados: {{ $pets->where('adopted', 1)->count() }}</span>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>TIPO</th>
                <th>PESO (kg)</th>
                <th>EDAD</th>
                <th>RAZA</th>
                <th>UBICACIÓN</th>
                <th>DESCRIPCIÓN</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
            <tr>
                <td class="text-center">{{ $pet->id }}</td>
                <td><strong>{{ $pet->name }}</strong></td>
                <td class="text-center">{{ $pet->kind }}</td>
                <td class="text-center">{{ number_format($pet->weight, 1) }}</td>
                <td class="text-center">
                    @if($pet->age < 1)
                        {{ $pet->age * 12 }} meses
                    @else
                        {{ number_format($pet->age, 0) }} años
                    @endif
                </td>
                <td>{{ $pet->breed ?: 'No especificada' }}</td>
                <td>{{ $pet->location ?: 'No especificada' }}</td>
                <td>{{ Str::limit($pet->description, 100) }}</td>
                <td class="text-center">
                    @if($pet->adopted)
                        <span class="status-adopted"> ADOPTADO</span>
                    @elseif($pet->active)
                        <span class="status-available"> DISPONIBLE</span>
                    @else
                        <span class="status-inactive"> INACTIVO</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="margin-top: 20px; text-align: center; font-size: 10px; color: #a0aec0;">
        Larapets - Sistema de Gestión de Mascotas
    </div>
</body>
</html>