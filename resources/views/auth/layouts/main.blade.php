<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Rozai Iskandar">
        <link rel="shortcut icon" href="{{ asset('images/logo/logo-bsi.png') }}" type="image/x-icon">

        <title>Inventory Barang</title>

        {{-- bootstrap css --}}
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        {{-- fontawesome online --}}
        <script src="https://kit.fontawesome.com/5d95be6567.js" crossorigin="anonymous"></script>

        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        {{-- <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> --}}
    </head>

    <body class="bg-success overflow-hidden">
        @include('sweetalert::alert')

        <!-- Content Mulai -->
        @yield('main-body')
        <!-- Content Selesai -->

        {{-- bootstrap js --}}
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        {{-- <script src="{{ asset('js/dashboard.js') }}"></script> --}}
    </body>
</html>