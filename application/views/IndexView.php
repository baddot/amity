<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <title>firegular</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="http://carlosroso.com/notyf/notyf.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=cyrillic">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        html, body {
            height: 100%;
            width: 100%;
        }
        body {
            font-family: "Roboto", sans-serif!important;
        }
        .btn {
            cursor: pointer;
        }
        .login {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fafafa;
        }
        .login form > .form-group > *, .login form button[type=submit] {
            font-family: "Roboto", sans-serif!important;
        }
        .login form .form-group:first-child {
            text-align: center;
        }
    </style>
</head>
<body>
    <section class="login">
        <form autocomplete="off">
            <div class="form-group">
                <h4>firegular <i class="ion-ios-flame-outline"></i></h4>
            </div>
            <div class="form-group">
                <input type="text" name="username" placeholder="Имя пользователя" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Пароль" class="form-control" required>
            </div>
            <button class="btn btn-primary" type="submit">Войти</button>
        </form>
    </section>
    <script src="/static/js/libs/notyf.min.js"></script>
    <script src="/static/js/index.js"></script>
</body>
</html>