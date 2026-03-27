<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>Muhammad Akbar | PT Emas Antam Indonesia Coding Test</title>
        <link rel="icon" href="https://emasantam.id/wp-content/uploads/2022/01/cropped-Master-Logo-gunung-kotak-kecil-32x32.png" type="image/png">
 
        @vite(['resources/css/app.css', 'resources/js/app.js'])
 
        @livewireStyles
    </head>
    <body>
        {{ $slot }}
 
        @livewireScripts
    </body>
</html>