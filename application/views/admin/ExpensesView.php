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
<body ng-controller="ExpensesController" ng-init="initSystem()">
    <div class="loader">
        <img src="/static/images/puff.svg">
    </div><!-- ./ loader -->
    <div class="wrapper">
        <ul class="sidebar" ng-include="_templates.sidebar"></ul><!-- ./ sidebar -->
        <div class="top-panel">
            <h4>Firegular: расходы</h4>
            <button class="btn add-transaction" data-toggle="modal" data-target=".add-expense-modal">Добавить расход</button>
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
                        <th width="10%">Идентификатор</th>
                        <th>Название</th>
                        <th>Сумма</th>
                        <th width="10%">Форма оплаты</th>
                        <th width="10%">Валюта</th>
                        <th width="10%">Платежная система</th>
                        <th>Дата</th>
                        <th>Категория</th>
                        <th>Подкатегория</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="expense in expenses | orderBy: 'expense.id'">
                        <td><i class="pe-7s-angle-down" style="color: var(--main-color); font-size: 45px;"></i></td>
                        <td>{{expense.id}}</td>
                        <td>{{expense.name}}</td>
                        <td>{{expense.sum}}</td>
                        <td>{{expense.payment_form_name}}</td>
                        <td>{{expense.payment_form_currency}}</td>
                        <td>{{expense.payment_form_bank_name}}</td>
                        <td>{{expense.date}}</td>
                        <td ng-click="filter: category_name">{{expense.category_name}}</td>
                        <td>{{expense.subcategory_name}}</td>
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
    <div class="modal fade add-expense-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить расход</h5>
                    <button class="close" data-dismiss="modal">
                        <span><i class="pe-7s-close"></i></span>
                    </button>
                </div><!-- ./ modal-header -->
                <div class="modal-body">
                    <form autocomplete="off" ng-submit="addExpense()">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Наименование расхода" ng-model="expense_name" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Сумма" ng-model="expense_sum" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" ng-model="payment_form_id" required>
                                <option value="" disabled selected>Форма оплаты</option>
                                <option ng-repeat="payment_form in payment_forms" value="{{payment_form.payment_form_id}}">{{payment_form.payment_form_bank_name + " " + payment_form.payment_form_currency + " " + payment_form.payment_form_name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control datepicker" placeholder="Дата" ng-model="expense_date" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" ng-model="subcategory_id" required>
                                <option value="" disabled selected>Подкатегория расхода</option>
                                <option ng-repeat="subcategory in subcategories" value="{{subcategory.id}}">{{subcategory.name}}</option>
                            </select>
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