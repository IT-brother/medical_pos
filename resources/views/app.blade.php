<!doctype html>
<html lang="en" class="">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!--favicon-->
    <link rel="icon" href="{{asset('images/logo.png')}}" type="image/png">
	@viteReactRefresh 
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    <!-- In this article, we are going to use JSX syntax for React components -->
    @inertiaHead
</head>
<body class="bg-gray-300">
	<!--wrapper-->
	<div>
		@inertia
	</div>
</body>
</html>