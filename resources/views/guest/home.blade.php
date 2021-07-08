<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Boolpress</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>


    {{-- <h1>Boolpress</h1> --}}
    <div id="app">

    </div>




    {{-- <div
        style="background-image: url({{ asset('img/bg-2.jpg') }}); background-repeat: no-repeat; background-size: cover; height: 100vh;"
    >
        <div style="background-color:white" class="d-flex justify-content-between align-items-center p-1">
            <div class="d-flex justify-content-start">
                <img style="height: 50px;" src="{{ asset('img/boolean-logo.jpg') }}" alt="">
                <span style="font-size:2em">Boolpress</span>
            </div>
            <div class="d-flex p-1">
                <div class="nav-item">
                    <a class="btn btn-primary btn-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
                </div>
                <div class="nav-item">
                    <a class="btn btn-outline-success btn-sm" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="d-flex justify-content-center p-1">
        <div class="nav-item">
            <a class="btn btn-primary btn-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
        </div>
        <div class="nav-item">
            <a class="btn btn-outline-success btn-sm" href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>
    </div>

</body>

</html>
