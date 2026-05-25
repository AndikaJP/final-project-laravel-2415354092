<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#202020] font-sans overflow-hidden">

    <div class="w-screen h-screen">

        <div class="bg-[#F5F5F5] w-full h-full flex overflow-hidden">

            <!-- SIDEBAR -->
            @include('components.sidebar')

            <!-- CONTENT -->
            <main class="flex-1 overflow-auto">

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>