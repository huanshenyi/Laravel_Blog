

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>ログイン</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            background-image:url("{{URL::asset('img/laravel-to.jpg')}}");
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        </style>
</head>

<body>

<div class="container">

    <form class="form-signin" method="POST" action="/login">
       {{csrf_field()}}
        <h2 class="form-signin-heading text-info">ログイン</h2>
        <label for="inputEmail" class="sr-only">メールアドレス</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">パスワード</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox text-info">
            <label>
                <input type="checkbox" value="1" name="is_remember" > ログイン状態を記録
            </label>
        </div>
        @include('layout.error')
        <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
        <a href="/register" class="btn btn-lg btn-primary btn-block" type="submit">新規アカウント>></a>
    </form>

</div> <!-- /container -->

</body>
</html>
