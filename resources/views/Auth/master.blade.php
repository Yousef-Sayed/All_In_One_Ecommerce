<!DOCTYPE html>
<html lang="{{ Session::get('lang') }}">
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>@yield('title')</title>

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
    @yield('linksDataView')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/core.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/all.min.css') }}">
	<script src="{{ asset('backend/sweetalert2@11.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/style.css') }}">

</head>

    @yield('content')
	<!-- js -->
	<script src="{{ asset('backend/vendors/scripts/core.js') }}"></script>
</html>















