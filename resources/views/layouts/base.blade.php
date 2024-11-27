<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/'.$css.'.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" href="/resources/assets/logoani.png" type="image/png">
</head>
<body>
    <script src="/resources/js/currency.js"></script>
    @yield('content')
    <script src="/resources/js/general.js"></script>
</body>
</html>