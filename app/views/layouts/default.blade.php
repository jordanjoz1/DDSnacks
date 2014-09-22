<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container">

    @include('includes.header')

    @yield('content')

    @include('includes.footer')
</div>
</body>
</html>
