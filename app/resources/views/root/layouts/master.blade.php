<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/sass/app.scss')
    @stack('third_party_stylesheets')
    @stack('page_css')

    {{-- Load jQuery --}}
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @yield('_content')
    
    @vite('resources/js/app.js')
    @stack('third_party_scripts')
    @stack('page_scripts')
</body>
</html>
