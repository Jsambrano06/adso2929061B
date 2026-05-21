<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Get All Pets (View)</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-700 min-h-dvh p-14">
    <h1 class="text-gray-200 text-4xl text-center border-b-2 pb-4">Get All Pets (View)</h1>
    <table class="table table-border mt-5 bg-gray-300 text-gray-950">
        <thead>
            <tr class="bg-gray-900 text-gray-200">
                <th>ID</th>
                <th>NAME</th>
                <th>KIND</th>
                <th>BREED</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
                <tr class="even:bg-gray-400">
                    <td>{{$pet->id}}</td>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->kind }}</td>
                    <td>{{ $pet->breed }}</td>
                    <td>
                        <a href="{{ url('show/pet/'.$pet->id) }}" class="bg-gray-800 flex p-2 text-gray-200 w-10 rounded-md justify-center scale-90 hover:scale-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path></svg>
                    </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
