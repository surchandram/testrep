<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Cyberhawk') }}</title>

        <!-- Fonts -->
        <!--<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,700,900&display=swap" rel="stylesheet" />-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- SVG Icons -->
        {!! file_get_contents(public_path('icons/svg-defs.svg')) !!}

        <!-- Scripts -->
        <script src="https://js.stripe.com/v3/"></script>
        @routes
        @vite([
            'node_modules/bootstrap-icons/font/bootstrap-icons.css',
            'resources/js/app.js',
            "resources/js/app/{$page['component']}.vue"
        ])
        @inertiaHead
    </head>
    <body class="font-inter antialiased" style="margin-bottom: 0 !important;">
        @inertia
    </body>
</html>
