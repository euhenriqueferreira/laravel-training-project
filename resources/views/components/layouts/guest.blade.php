<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Tests</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <div class="w-screen h-screen flex justify-center items-center relative">
        <x-switch-theme />

        {{ $slot }}

        <script src="{{ asset('js/switchDarkMode.js') }}"></script>
    </div>
</body>
</html>
