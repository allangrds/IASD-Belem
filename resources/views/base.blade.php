<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IASD Belém</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"></script>
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@yield('content')
<script>
    (function () {
        var burger = document.querySelector('.burger');
        var menu = document.querySelector('.' + burger.dataset.target);
        burger.addEventListener('click', function () {
            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });
    })();
</script>
@yield('script')
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
