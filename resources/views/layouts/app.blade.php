<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@include('layouts.head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Try Nav --}}

</head>
<body>
    <div id="app">
        @include('layouts.navbar',['lastNum_adquisicion' => App\Models\Libro::where('activo',1)->orderBy('num_adquisicion','desc')->take(1)->pluck('num_adquisicion')])
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @include('layouts.scripts')

</body>
</html>
