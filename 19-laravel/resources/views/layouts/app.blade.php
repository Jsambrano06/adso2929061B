<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-dvh flex flex-col gap-2 justify-center items-center bg-no-repeat bg-center bg-cover"
    style="background-image: linear-gradient(to top, #000a, #000a), url('{{ asset('images/bg-welcome.avif') }}');">

    <main>
        @yield('content')
    </main>

    @hasSection('js')
        <script>
            @yield('js')
        </script>
    @endif

</body>

</html>
