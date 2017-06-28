<!doctype html>
<html lang="ru" ng-app="Firegular" ng-controller="FiregularController">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <title></title>
    <link rel="icon" href="/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=cyrillic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext">
    <link rel="stylesheet" href="/static/css/bundle.min.css">
</head>
<body ng-init="initSystem()">
    <div class="loader">
        <img src="/static/images/puff.svg">
    </div><!-- ./ loader -->
    <div class="wrapper">
        <ul class="sidebar" ng-include="_templates.sidebar"></ul><!-- ./ sidebar -->
        <div class="top-panel">
            <h4>Firegular</h4>
            <div class="user">
                <h5>Валюты [USD: {{current_dollar == "undefined" ? "Не задано" : current_dollar}} | RUB: {{current_ruble == "undefined" ? "Не задано" : current_ruble}} ]</h5>
                <i class="pe-7s-like" data-toggle="modal" data-target=".profile-settings-modal"></i>
                <span>Привет, <? echo $this->session->userdata("username") ?>!</span>
                <button class="btn logout-button" ng-controller="LogoutController" ng-click="logout()">Выйти</button>
            </div>
        </div><!-- ./ top-panel -->
        <main class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 item">
                        <i class="pe-7s-way"></i>
                        <h2>Менеджмент</h2>
                        <p>Управление пользователями системы</p>
                        <a href="/user/all-users" class="btn btn-secondary">Перейти</a>
                    </div>
                    <div class="col-md-4 item">
                        <i class="pe-7s-cash"></i>
                        <h2>Валюта</h2>
                        <p>Измени сегодняшний курс</p>
                        <a href="#" class="btn btn-secondary" data-toggle="modal" data-target=".change-currency-modal">Перейти</a>
                    </div>
                    <div class="col-md-4 item">
                        <i class="pe-7s-expand1"></i>
                        <h2>Баланс</h2>
                        <p>Тщательно проверяй баланс</p>
                        <a href="/user/balance" class="btn btn-secondary">Перейти</a>
                    </div>
                    <div class="col-md-4 item">
                        <i class="pe-7s-upload"></i>
                        <h2>Доходы</h2>
                        <p>Следи за доходом</p>
                        <a href="/user/incomes" class="btn btn-secondary">Перейти</a>
                    </div>
                    <div class="col-md-4 item">
                        <i class="pe-7s-download"></i>
                        <h2>Расходы</h2>
                        <p>Будь бдительнее с деньгами</p>
                        <a href="/user/expenses" class="btn btn-secondary">Перейти</a>
                    </div>
                    <div class="col-md-4 item">
                        <i class="pe-7s-graph2"></i>
                        <h2>Статистика</h2>
                        <p>Все графики и изменения за определенный промежуток</p>
                        <a href="/user/statistics" class="btn btn-secondary">Перейти</a>
                    </div>
                </div>
            </div>
        </main><!-- ./ main -->
    </div><!-- ./ wrapper -->
    <!-- add user modal -->
    <div class="modal fade add-user-modal" ng-include="_templates.addUserModal"></div>
    <!-- ./ add user modal -->
    <!-- profile settings modal -->
    <div class="modal fade profile-settings-modal" ng-include="_templates.profileSettingsModal"></div>
    <!-- ./ profile settings model -->
    <!-- change currency modal -->
    <div class="modal fade change-currency-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Изменить текущий курс валют</h5>
                    <button class="close" data-dismiss="modal">
                        <span><i class="pe-7s-close"></i></span>
                    </button>
                </div><!-- ./ modal-header -->
                <div class="modal-body">
                    <form autocomplete="off" ng-submit="setCurrency()">
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="current_dollar_model" placeholder="Текущий курс доллара" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="current_ruble_model" placeholder="Текущий курс рубля" required>
                        </div>
                        <button class="btn cancel-button" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn save-button">Изменить</button>
                    </form>
                </div><!-- ./ modal-body -->
            </div>
        </div>
    </div>
    <!-- ./ change currency modal -->
    <script src="/static/js/libs/angular.min.js"></script>
    <script src="/static/js/libs/jquery.min.js"></script>
    <script src="/static/js/libs/tether.min.js"></script>
    <script src="/static/js/libs/bootstrap.min.js"></script>
    <script src="/static/js/libs/notyf.min.js"></script>
    <script src="/static/js/libs/underscore.min.js"></script>
    <script src="/static/js/libs/moment.min.js"></script>
    <script src="/static/js/modules/admin.js"></script>
</body>
</html>