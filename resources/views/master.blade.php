<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>CenterShot - @yield('title')</title>

    <!-- jquery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!--bootsrap-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!--Materialize-->
    <!-- Compiled and minified CSS -->
    <!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">-->

    <!-- Compiled and minified JavaScript -->
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>-->

    <!--UIKit-->
    <!--<link rel="stylesheet" href="./css/uikit.gradient.min.css" />-->
    <!--<script src="./js/uikit.min.js"></script>-->
    <!--<script src="./js/components/datepicker.js"></script>-->
    <!--<script src="./js/components/form-select.js"></script>-->

    <!--Import Google Icon Font-->
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Web font -->
    <!--<link href='//fonts.googleapis.com/css?family=Hind:600' rel='stylesheet' type='text/css'>-->

@yield('js')

    <script type="text/javascript">
        $(function() {
            //init ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

        @yield('script_ready')
        });

        @yield('script_other')
    </script>

    <style type="text/css">
        #copyright {
            position: fixed;
            bottom: 0px;
            left: 0px;
            font-size: 0.5em;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            cursor: default;
        }

        @yield('style')
    </style>
</head>
<body>
    <div class="container-fluid">
@yield('content')
        <footer><div id="copyright">&copy;310uk</div></footer>
    </div>
</body>
</html>