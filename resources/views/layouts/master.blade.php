<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> CNMH </title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cnmh2-production.up.railway.app/build/assets/app-993a4911.css">


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
    <script src="https://cnmh2-production.up.railway.app/build/assets/app-e421d829.js"></script>
    <script>
        $(document).ready(() => {
            // $('.menu-open').click()
        })
    </script>
</body>

</html>
