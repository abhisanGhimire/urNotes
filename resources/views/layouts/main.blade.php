<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.header')
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
<body>
    <div id="app">
        @include('layouts.nav')
        <main class="p-4">
            @yield('content')
        </main>
    </div>
</body>

@include('layouts.scripts')
</html>
