<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Usuarios - Larapets</title>
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

        .user-photo {
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

        .status-active {
            color: #48bb78;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            background: #f0fff4;
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

        .role-admin {
            background-color: #ed64a6;
            color: white;
            padding: 3px 10px;
            border-radius: 4px;
            display: inline-block;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
        }

        .role-moderator {
            background-color: #4299e1;
            color: white;
            padding: 3px 10px;
            border-radius: 4px;
            display: inline-block;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
        }

        .role-customer {
            background-color: #48bb78;
            color: white;
            padding: 3px 10px;
            border-radius: 4px;
            display: inline-block;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
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
                <th width="10%">DOCUMENTO</th>
                <th width="15%">NOMBRE COMPLETO</th>
                <th width="8%">GÉNERO</th>
                <th width="10%">FECHA NAC.</th>
                <th width="6%">EDAD</th>
                <th width="10%">TELÉFONO</th>
                <th width="15%">EMAIL</th>
                <th width="8%">ROL</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td class="text-center">{{ $user->id }}</td>
                <td class="text-center">
                    @php
                        $photoPath = public_path('images/' . $user->photo);
                        $noPhotoPath = public_path('images/no-photo.png');
                        $isValidPhoto = false;

                        if($user->photo && $user->photo != 'no-photo.png' && $user->photo != '') {
                            $photoExtension = strtolower(pathinfo($user->photo, PATHINFO_EXTENSION));
                            if(in_array($photoExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp']) && file_exists($photoPath)) {
                                $isValidPhoto = true;
                            }
                        }
                    @endphp

                    @if($isValidPhoto)
                        <img src="{{ $photoPath }}" class="user-photo" alt="Foto {{ $user->fullname }}">
                    @else
                        <img src="{{ $noPhotoPath }}" class="no-photo" alt="Sin foto">
                    @endif
                </td>
                <td class="text-center">{{ number_format($user->document, 0, '', '.') }}</td>
                <td class="font-bold">{{ strtoupper($user->fullname) }}</td>
                <td class="text-center">
                    @if($user->gender == 'Male')
                        Masculino
                    @elseif($user->gender == 'Female')
                        Femenino
                    @else
                        {{ $user->gender }}
                    @endif
                </td>
                <td class="text-center">{{ \Carbon\Carbon::parse($user->birthdate)->format('d/m/Y') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($user->birthdate)->age }} años</td>
                <td class="text-center">{{ $user->phone }}</td>
                <td style="font-size: 10px;">{{ strtolower($user->email) }}</td>
                <td class="text-center">
                    @if($user->role == 'Admin')
                        <span class="role-admin">ADMIN</span>
                    @elseif($user->role == 'Moderator')
                        <span class="role-moderator">MODERADOR</span>
                    @else
                        <span class="role-customer">CLIENTE</span>
                    @endif
                </td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</body>
</html>