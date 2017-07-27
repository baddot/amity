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
<body ng-controller="BalanceController" ng-init="initSystem()">
    <div class="loader">
        <img src="/static/images/puff.svg">
    </div><!-- ./ loader -->
    <div class="wrapper">
        <ul class="sidebar" ng-include="_templates.sidebar"></ul><!-- ./ sidebar -->
        <div class="top-panel">
            <h4>{{title}}: баланс</h4>
            <div class="user">
                <i class="pe-7s-like" data-toggle="modal" data-target=".profile-settings-modal"></i>
                <span>Привет, <? echo $this->session->userdata("username") ?>!</span>
                <button class="btn logout-button" ng-controller="LogoutController" ng-click="logout()">Выйти</button>
            </div>
        </div><!-- ./ top-panel -->
        <main class="main balance">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="balance-title"><i class="ion-arrow-graph-up-left"></i>Касса</h1>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-block">
                                    <h3 class="card-title">Наличные</h3>
                                    <p class="card-text">$: {{nal_usd}}</p>
                                    <p class="card-text">Грн: {{nal_uah}}</p>
                                    <p class="card-text">Р: {{nal_rub}}</p>
                                </div>
                            </div><!-- ./ card -->
                        </div><!-- ./ col-md-4 -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-block">
                                    <h3 class="card-title">Безналичные</h3>
                                    <p class="card-text">ПБ: {{b_nal_pb}}</p>
                                    <p class="card-text">QIWI: {{b_nal_qiwi}}</p>
                                    <p class="card-text">WMZ: {{b_nal_wmz}}</p>
                                    <p class="card-text">WMR: {{b_nal_wmr}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1 class="balance-title"><i class="ion-card"></i>Банк</h1>
                    </div>
                </div>
            </div>
        </main><!-- ./ main -->
    </div><!-- ./ wrapper -->
    <!-- convert modal -->
    <div class="modal fade convert-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" ng-controller="ConvertController">
                <div class="modal-header">
                    <h5 class="modal-title">Конвертация</h5>
                    <button class="close" data-dismiss="modal">
                        <span><i class="pe-7s-close"></i></span>
                    </button>
                </div><!-- ./ modal-header -->
                <div class="modal-body">
                    <form autocomplete="off" ng-submit="convert()">
                        <div class="form-group">
                            <select class="form-control" ng-model="from" required>
                                <option value="" disabled selected>Откуда</option>
                                <option ng-repeat="payment_system in payment_systems" value="{{payment_system.payment_system_name}}">{{payment_system.payment_system_name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" ng-model="to" required>
                                <option value="" disabled selected>Куда</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" ng-model="sum" placeholder="Сумма" required>
                        </div>
                        <button class="btn cancel-button" data-dismiss="modal">Отмена</button>
                        <button class="btn add" type="submit">Конвертировать</button>
                    </form>
                </div><!-- ./ modal-body -->
            </div>
        </div>
    </div>
    <!-- ./ convert modal -->
    <!-- profile settings modal -->
    <div class="modal fade profile-settings-modal" ng-include="_templates.profileSettingsModal"></div>
    <!-- ./ profile settings modal -->
    <script src="/static/js/bundle.min.js"></script>
    <script src="/static/js/modules/admin.js"></script>
</body>
</html>
