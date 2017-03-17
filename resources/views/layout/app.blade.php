<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/normalize.css">
    <link href="https://fonts.googleapis.com/earlyaccess/sawarabigothic.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.3/clipboard.min.js"></script>
    <script>
        $(function () {
            var clipboard = new Clipboard('.btn');
        });

        clipboard.on('success', function(e) {
            e.clearSelection();
        });
    </script>

    @yield('start_script')
    <title>ここキテ</title>
</head>
<body>

    @yield('content')


    @yield('end_script')

</body>
</html>