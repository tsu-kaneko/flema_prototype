<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

        @yield('head')
        
        <title>@yield('title')</title>

        <style>
            .breadcrumb > li + li:before {
                content: ">";
            }
        </style>
    </head>
    <body>
<!--        @section('sidebar')
            ここがメインのサイドバー
        @show-->
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
