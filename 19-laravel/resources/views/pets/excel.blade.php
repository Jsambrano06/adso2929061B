<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Pets</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Kind</th>
                <th>Breed</th>
                <th>Weight (kg)</th>
                <th>Age (yrs)</th>
                <th>Location</th>
                <th>Description</th>
                <th>Active</th>
                <th>Adopted</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
            <tr>
                <td>{{ $pet->id }}</td>
                <td>{{ $pet->name }}</td>
                <td>{{ ucfirst($pet->kind) }}</td>
                <td>{{ $pet->breed }}</td>
                <td>{{ $pet->weight }}</td>
                <td>{{ $pet->age }}</td>
                <td>{{ $pet->location }}</td>
                <td>{{ $pet->description }}</td>
                <td>{{ $pet->active ? 'Yes' : 'No' }}</td>
                <td>{{ $pet->adopted ? 'Adopted' : 'Available' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
