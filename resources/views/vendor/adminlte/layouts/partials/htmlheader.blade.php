<head>
    <meta charset="UTF-8">
    <title>Projeto +Serviços </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/adminlte-app.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    
    @yield('styles')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
