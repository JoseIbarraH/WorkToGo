<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTWORK</title>
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>
<body>
    @include('layouts\partials\navbar3')
    <main class="container">
        @yield('content')
    </main>

    <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>