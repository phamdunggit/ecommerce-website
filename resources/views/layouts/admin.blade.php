<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="{{ asset('admin/css/material-dashboard.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css')}}" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        @include('layouts.includes.sidebar')
        <div class="main-panel">
            @include('layouts.includes.adminnav')
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.includes.adminfooter')
        </div>
    </div>

    <script src="{{ asset('admin/js/jquery.min.js')}}" ></script>
    <script src="{{ asset('admin/js/popper.min.js')}}" ></script>
    <script src="{{ asset('admin/js/bootstrap-material-design.min.js')}}"></script>
    <script src="{{ asset('admin/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('admin/js/custom.js')}}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
    @if(session('status'))
    <script>
        swal({
            title: "{{session('status')}}",
            text: "",
            icon: "success",
            button: "OK",
        });
    </script>
    @endif
    @yield('scripts')

</body>

</html>