<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $pageTitle }} </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Styles -->
    <livewire:styles />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="dark-primary h-screen flex flex-col ">
{{--<body class="h-screen flex flex-col bg-teal-100 dark:bg-cyan-900 dark:text-white-200">--}}

    <livewire:header />

    <!-- Main Container -->
    <div class="flex flex-1 overflow-hidden">

        <!-- Left Sidebar -->
        <aside class="w-64 bg-gray-100 p-4 pt-6 flex flex-col gap-4 dark-secondary">
            <livewire:category-list />
            <livewire:favorite-list />
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6 dark-secondary">
            <livewire:article-list />
        </main>

    </div>

</body>

</html>
