<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.header')

<body style="background-color: #759cc4	;">
    <div id="app" class="bg-dark">
        @include('layouts.nav')
        <main class="p-4">
            @yield('content')
        </main>
    </div>
</body>
<link rel="stylesheet" href="{{ asset('prism.css') }}">
</link>
@include('layouts.scripts')
</html>
