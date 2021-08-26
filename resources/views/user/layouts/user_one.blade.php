<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="turbolinks-cache-control" content="no-cache">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="">

<link href="{{ asset('icon.png') }}" rel="shortcut icon" type="image/x-icon">
<title>@yield('title') - {{ config('settings.site_name') }}</title>
@include('user.partials.styles')
@yield('css')
</head>
<body>
@include('user.partials.header')
@livewire('user.add-to-cart')
<!-- Page Content -->
@yield('content')
@include('user.partials.footer')
@include('user.partials.scripts')
@yield('js')
</body>
</html>