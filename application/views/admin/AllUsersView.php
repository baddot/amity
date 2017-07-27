<!doctype html>
<html lang="ru" ng-app="Amity" ng-controller="AmityController">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <title></title>
    <link rel="icon" href="/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=cyrillic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext">
    <link rel="stylesheet" href="/static/css/bundle.min.css">
</head>
<body ng-controller="AllUsersController" ng-init="initSystem()">
    <div class="loader">
        <img src="/static/images/puff.svg">
    </div><!-- ./ loader -->
    <div class="wrapper">
        <ul class="sidebar" ng-include="_templates.sidebar"></ul><!-- ./ sidebar -->
        <div class="top-panel">
            <h4>{{title}}: пользователи</h4>
            <div class="user">
                <i class="pe-7s-like" data-toggle="modal" data-target=".profile-settings-modal"></i>
                <span>Привет, <? echo $this->session->userdata("username") ?>!</span>
                <button class="btn logout-button" ng-controller="LogoutController" ng-click="logout()">Выйти</button>
            </div>
        </div><!-- ./ top-panel -->
        <main class="main" ng-init="getAllUsers()">
            <div class="container-fluid">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Идентификатор</th>
                            <th>Логин</th>
                            <th>Пароль</th>
                            <th width="1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="user in users">
                            <td>{{user.id}}</td>
                            <td>{{user.username}}</td>
                            <td>{{user.password}}</td>
                            <td>
                                <i class="pe-7s-trash" ng-click="deleteUser(user)" style="color: #000"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main><!-- ./ main -->
    </div><!-- ./ wrapper -->
    <!-- add user modal -->
    <div class="modal fade add-user-modal" ng-include="_templates.addUserModal"></div>
    <!-- ./ add user modal -->
    <!-- profile settings modal -->
    <div class="modal fade profile-settings-modal" ng-include="_templates.profileSettingsModal"></div>
    <!-- ./ profile settings modal -->
    <script src="/static/js/bundle.min.js"></script>
    <script src="/static/js/modules/admin.js"></script>
</body>
</html>
