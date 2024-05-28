<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Font Awesome --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.css' integrity='sha512-U9Y1sGB3sLIpZm3ePcrKbXVhXlnQNcuwGQJ2WjPjnp6XHqVTdgIlbaDzJXJIAuCTp3y22t+nhI4B88F/5ldjFA==' crossorigin='anonymous'/>

    {{-- Alpine     --}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.14.0/cdn.js' integrity='sha512-z6F6XBybddChHDc/36z8WZzvOW8pdlUKne6R5E7PGIo7v9S8AZF8vlhm2hbiAAjKpKbfO9K8Yer0w6U1xYsQjQ==' crossorigin='anonymous'></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title> Admin laravel-auth</title>
</head>
<body>

    @include('admin.partials.header')

    <div class="main-wrapper d-flex">
        @include('admin.partials.aside')
        <div class="content p-5 w-100 overflow-auto">
            @yield('content')
        </div>
    </div>


</body>
</html>
