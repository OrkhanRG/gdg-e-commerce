<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    @stack('css')
</head>
<body>
<div class="main-wrapper">

    @include('layouts.admin.sidebar');

    <div class="page-wrapper">

        @include('layouts.admin.navbar')

        <div class="page-content">
            @yield('content')
        </div>

        <footer
            class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
            <p class="text-muted mb-1 mb-md-0">Copyright © {{ date('Y') }} <a href="javascript:void(0)">E-Commerce</a>.
            </p>
            <p class="text-muted">Orxan İsmayilov <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i>
            </p>
        </footer>
    </div>
</div>

<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
@include('sweetalert::alert')
@stack('js')

</body>
</html>
