@extends('components.navbar')
@extends('components.footer')
@extends('components.cardproduct')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>

    {{-- Navbar --}}
    <x-navbar />

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />
    <x-cardproduct />





</body>
</html>
