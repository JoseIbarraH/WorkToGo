<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTWORK</title>
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/slider.css')}}">


</head>
<body>
    @include('layouts\partials\navbar')
    <div class="container">
        @yield('content')
    </div>

    <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>