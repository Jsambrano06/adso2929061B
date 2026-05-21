<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pet Details - {{ $pet->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-700 min-h-dvh p-14">
    <h1 class="text-gray-200 text-4xl text-center border-b-2 pb-4 mb-6">Pet Details - {{ $pet->name }}</h1>
    <table class="table table-border mt-5 bg-gray-300 text-gray-950 mx-auto max-w-4xl">
        <tbody>
        @if ($pet->image)
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/'.$pet->image) }}" alt="{{ $pet->name }}"
                    class="w-60 h-60 object-cover rounded-lg shadow-lg border-4 border-white">
            </div>
        @endif
            <tr class="even:bg-gray-400">
                <td class="font-bold">ID</td>
                <td>{{ $pet->id }}</td>
            </tr>
            <tr class="even:bg-gray-400">
                <td class="font-bold">Name</td>
                <td>{{ $pet->name }}</td>
            </tr>
            <tr class="even:bg-gray-400">
                <td class="font-bold">Kind</td>
                <td>{{ $pet->kind }}</td>
            </tr>
            <tr class="even:bg-gray-400">
                <td class="font-bold">Breed</td>
                <td>{{ $pet->breed }}</td>
            </tr>
            <tr class="even:bg-gray-400">
                <td class="font-bold">Age</td>
                <td>{{ $pet->age }} years</td>
            </tr>
            <tr class="even:bg-gray-400">
                <td class="font-bold">Weight</td>
                <td>{{ $pet->weight }} kg</td>
            </tr>
            <tr class="even:bg-gray-400">
                <td class="font-bold">Location</td>
                <td>{{ $pet->location }}</td>
            </tr>
            <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">Status</td>
                    <td class="px-4 py-3">
                        @if($pet->active)
                            <span class="bg-green-600 text-white px-2 py-1 rounded">Adopted</span>
                        @else
                            <span class="bg-red-600 text-white px-2 py-1 rounded">Not Adopted</span>
                        @endif
                    </td>
                </tr>
                <tr class="even:bg-gray-400">
                    <td class="font-bold px-4 py-3">Adopted</td>
                    <td class="px-4 py-3">
                        @if($pet->adopted)
                            <span class="bg-green-600 text-white px-2 py-1 rounded">Yes</span>
                        @else
                            <span class="bg-yellow-600 text-white px-2 py-1 rounded">No</span>
                        @endif
                    </td>
                </tr>
            <tr class="even:bg-gray-400">
                <td class="font-bold">Description</td>
                <td>{{ $pet->description ?? 'No description available' }}</td>
            </tr>
            <tr class="even:bg-gray-400">
                <td class="font-bold">Created At</td>
                <td>{{ $pet->created_at->format('M d, Y H:i:s') }}</td>
            </tr>
            <tr class="even:bg-gray-400">
                <td class="font-bold">Updated At</td>
                <td>{{ $pet->updated_at->format('M d, Y H:i:s') }}</td>
            </tr>

        </tbody>
    </table>
    <div class="text-center mt-6">
            <a href="{{ url('getall/pets') }}"
                class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition-all border-4 border-white">
                Back
            </a>
        </div>
</body>

</html>
