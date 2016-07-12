<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Testing Platform</title>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css\main.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="head.ico" />
    <link rel="stylesheet" href="/css/font-awesome.min.css">
</head>

<body>

    <nav class="navbar navbar-default nav-cus">
      <span class="head-tx">WEB  BROWSER  TESTING</span>
      <img src="img/fresh-icon.png" class="fresh-icon ">
    </nav>

    <div class="container content">
        @yield('content')
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    @yield('script')
</body>

</html>
