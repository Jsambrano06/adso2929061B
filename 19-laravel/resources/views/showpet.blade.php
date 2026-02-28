<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-cyan-700 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">

        <h1 class="text-4xl text-center text-cyan-200 mb-6 border-b-4 border-cyan-300 pb-3">
            Pet Details
        </h1>

        @if ($pet->image)
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/'.$pet->image) }}" alt="{{ $pet->name }}"
                    class="w-48 h-48 object-cover rounded-lg shadow-lg border-4 border-cyan-300">
            </div>
        @endif

        <table class="table bg-cyan-300 text-cyan-950">
            <tbody>
                <tr class="bg-cyan-900 text-cyan-200">
                    <th colspan="2" class="text-center text-xl">
                        {{ $pet->name }}
                    </th>
                </tr>

                <tr class="even:bg-cyan-400">
                    <th>ID</th>
                    <td>{{ $pet->id }}</td>
                </tr>

                <tr class="even:bg-cyan-400">
                    <th>Name</th>
                    <td>{{ $pet->name }}</td>
                </tr>

                <tr class="even:bg-cyan-400">
                    <th>Kind</th>
                    <td>{{ $pet->kind }}</td>
                </tr>

                <tr class="even:bg-cyan-400">
                    <th>Breed</th>
                    <td>{{ $pet->breed }}</td>
                </tr>

                <tr class="even:bg-cyan-400">
                    <th>Adopted</th>
                    <td>{{ $pet->adopted ? 'Yes' : 'No' }}</td>
                </tr>

                <tr class="even:bg-cyan-400">
                    <th>Location</th>
                    <td>{{ $pet->location }}</td>
                </tr>

                <tr class="even:bg-cyan-400">
                    <th>Age</th>
                    <td>{{ $pet->age }}</td>
                </tr>

                <tr class="even:bg-cyan-400">
                    <th>Description</th>
                    <td>{{ $pet->description }}</td>
                </tr>

                <tr class="even:bg-cyan-400">
                    <th>Created At</th>
                    <td>{{ $pet->created_at->diffForHumans() }}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-6">
            <a href="{{ url('getall/pets') }}"
                class="bg-cyan-600 text-cyan-200 px-6 py-2 rounded-lg hover:bg-cyan-800 transition-all">
                Back
            </a>
        </div>

    </div>

</body>

</html>
