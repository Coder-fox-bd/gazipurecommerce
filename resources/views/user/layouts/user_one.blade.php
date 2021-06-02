<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>@yield('title')</title>
@include('user.partials.styles')
@yield('css')
</head>
<body>
@include('user.partials.header')
<!-- Page Content -->
@yield('content')
@include('user.partials.footer')
@include('user.partials.scripts')
@yield('js')
</body>
</html>