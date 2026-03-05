<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tittle')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />

</head>

<body
    class="bg-[linear-gradient(to_top,#000a,#000a),url('images/bg-welcome.avif')] min-h-dvh flex flex-col gap-2 justify-center items-center bg-no-repeat bg-center bg-cover">

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <script>
        @yield('js')
    </script>

</body>

</html>
