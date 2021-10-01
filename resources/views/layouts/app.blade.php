<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <style>
        body {
            padding: 20px;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 20px;
        }
    </style>

    {{--    linkando a pagina de estilo no diretorio public--}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/scripts.js')}}"></script>
    <title>Cadastro de produtos</title>
</head>
<body>
    <div class="container">
        @component('components.navbar', ['current' => $current])
        @endcomponent
        <main role="main">
            @if (session('danger'))
                <div class="alert alert-danger" role="alert">
                {{session('danger')}}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                {{session('success')}}
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning" role="alert">
                {{session('warning')}}
                </div>
            @endif
            
            @hasSection('body')
                @yield('body')
            @endif

            
        </main>
    </div>

    {{--    linkando a pagina de script no diretorio public--}}
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>

    @hasSection('javascript')
        @yield('javascript')
    @endif

    
</body>
</html>
