<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ auth()->user()->api_token }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    

    <style>
        
        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s;
        }
        .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
            opacity: 0;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }

        @media screen {
            .no-screen {
                display: none !important;
            }
        }
    </style>

    

    <!-- Styles -->
    
</head>
<body>
    <div id="app" data-app></div> 
    <script>
        //var env.debug = 

        window.env = {
            debug: {{ env('APP_DEBUG',false) ? 1 : 0 }}
        };

    </script>
    
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>