<!doctype html>
<html lang="ru" ng-app="Firegular" ng-controller="FiregularController">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <title></title>
    <link rel="icon" href="/favicon.png">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/css/Pe-icon-7-stroke.css">
    <link rel="stylesheet" href="http://carlosroso.com/notyf/notyf.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=cyrillic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext">
    <link rel="stylesheet" href="/static/css/datepicker.css">
    <link rel="stylesheet" href="/static/css/app.css">
    <link rel="stylesheet" href="/static/css/transactions.css">
</head>
<body ng-controller="IncomesController" ng-init="initSystem()">
    <div class="loader">
        <img src="/static/images/puff.svg">
    </div><!-- ./ loader -->
    <div class="wrapper">
        <ul class="sidebar" ng-include="_templates.sidebar"></ul><!-- ./ sidebar -->
        <div class="top-panel">
            <h4>Firegular: доходы</h4>
            <button class="btn add-transaction" data-toggle="modal" data-target=".add-income-modal">Добавить доход</button>
            <div class="user">
                <i class="pe-7s-like" data-toggle="modal" data-target=".profile-settings-modal"></i>
                <span>Привет, <? echo $this->session->userdata("username") ?>!</span>
                <button class="btn logout-button" ng-controller="LogoutController" ng-click="logout()">Выйти</button>
            </div>
        </div><!-- ./ top-panel -->
        <main class="main">
            <div class="container-fluid">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="2%"></th>
                            <th width="10%" ng-click="orderBy('income_id')">Идентификатор</th>
                            <th>Название</th>
                            <th>Сумма</th>
                            <th width="10%" ng-click="orderBy('payment_form_name')">Форма оплаты</th>
                            <th width="10%">Валюта</th>
                            <th width="10%" ng-click="orderBy('payment_form_bank_name')">Платежная система</th>
                            <th ng-click="orderBy('partner_name')">Контрагент</th>
                            <th>Дата</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="income in incomes | orderBy: filter">
                            <td><i class="pe-7s-angle-up"></i></td>
                            <td>{{income.id}}</td>
                            <td>{{income.name}}</td>
                            <td>{{income.sum}}</td>
                            <td>{{income.payment_form_name}}</td>
                            <td>{{income.payment_form_currency}}</td>
                            <td>{{income.payment_form_bank_name}}</td>
                            <td>{{income.partner_name}}</td>
                            <td>{{income.date}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main><!-- ./ main -->
    </div><!-- ./ wrapper -->
    <!-- add user modal -->
    <div class="modal fade add-user-modal" ng-include="_templates.addUserModal"></div>
    <!-- ./ add user modal -->
    <!-- add income modal -->
    <div class="modal fade add-income-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить доход</h5>
                    <button class="close" data-dismiss="modal">
                        <span><i class="pe-7s-close"></i></span>
                    </button>
                </div><!-- ./ modal-header -->
                <div class="modal-body">
                    <form autocomplete="off" ng-submit="addIncome()">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Наименование дохода" ng-model="income_name" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Сумма" ng-model="income_sum" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" ng-model="payment_form_id" required>
                                <option value="" disabled selected>Форма оплаты</option>
                                <option ng-repeat="payment_form in payment_forms" value="{{payment_form.payment_form_id}}">{{payment_form.payment_form_bank_name + " " + payment_form.payment_form_currency + " " + payment_form.payment_form_name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" ng-model="partner_id" required>
                                <option value="" disabled selected>От партнера</option>
                                <option ng-repeat="partner in partners" value="{{partner.id}}">{{partner.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control datepicker" placeholder="Дата" ng-model="income_date" required>
                        </div>
                        <button class="btn cancel-button" data-dismiss="modal">Отмена</button>
                        <button class="btn save-button" type="submit">Добавить</button>
                    </form>
                </div><!-- ./ modal-body -->
            </div>
        </div>
    </div>
    <!-- ./ add income modal -->
    <!-- profile settings modal -->
    <div class="modal fade profile-settings-modal" ng-include="_templates.profileSettingsModal"></div>
    <!-- ./ profile settings model -->
    <script src="/static/js/libs/angular.min.js"></script>
    <script src="/static/js/libs/jquery.min.js"></script>
    <script src="/static/js/libs/tether.min.js"></script>
    <script src="/static/js/libs/bootstrap.min.js"></script>
    <script src="/static/js/libs/notyf.min.js"></script>
    <script src="/static/js/libs/underscore.min.js"></script>
    <script src="/static/js/libs/moment.min.js"></script>
    <script src="/static/js/libs/moment-datepicker.js"></script>
    <script src="/static/js/libs/ru.js"></script>
    <script src="/static/js/modules/admin.js"></script>
</body>
</html>