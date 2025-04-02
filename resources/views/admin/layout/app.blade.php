<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>@yield('title')</title>
    <!-- Add your CSS files here -->
    @stack('styles')
</head>
<body>
    <!-- Include Header -->
    @include('admin.partials.header')
    
        <!-- Include Sidebar -->
        @include('admin.partials.sidebar')
        
        <!-- Main Content Area -->
        <main class="content">
            @yield('content')
        </main>

    {{--  <!-- Include Footer if you have one -->
    <!-- @include('footer') -->  --}}

    <!-- Add your JS files here -->
    {{--  @stack('scripts')  --}}
</body>
</html>