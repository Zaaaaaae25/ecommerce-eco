<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>@yield('title','EcoMart')</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

  <x-navbar />

  <main class="container mx-auto px-6 py-8">
    @yield('content')
  </main>

  <x-footer />

</body>
</html>
