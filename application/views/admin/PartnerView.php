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
    <link rel="stylesheet" href="/static/css/app.css">
    <link rel="stylesheet" href="/static/css/partner.css">
</head>
<body ng-controller="PartnerController" ng-init="initSystem()">
    <div class="loader">
        <img src="/static/images/puff.svg">
    </div><!-- ./ loader -->
    <div class="wrapper">
        <ul class="sidebar" ng-include="_templates.sidebar"></ul><!-- ./ sidebar -->
        <div class="top-panel">
            <h4>Firegular: партнеры</h4>
            <button class="btn add-partner" data-toggle="modal" data-target=".add-partner-modal">Добавить партнера</button>
            <div class="user">
                <i class="pe-7s-like" data-toggle="modal" data-target=".profile-settings-modal"></i>
                <span>Привет, <? echo $this->session->userdata("username") ?>!</span>
                <button class="btn logout-button" ng-controller="LogoutController" ng-click="logout()">Выйти</button>
            </div>
        </div><!-- ./ top-panel -->
        <main class="main partner">
            <div class="container-fluid">
                <div class="row">
                    <div class="partner-handlers">
                        <input class="search" placeholder="Поиск" ng-model="">
                    </div>
                    <table class="table table-striped table-partners">
                        <thead>
                            <tr>
                                <th>Идентификатор</th>
                                <th>Партнер (организация)</th>
                                <th>Телефон</th>
                                <th>Email</th>
                                <th>Категория услуг</th>
                                <th>Представитель</th>
                                <th>Тел. представителя</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="partner in partners | filter: partner_name | orderBy: 'partner.partner_id'">
                                <td>{{partner.id}}</td>
                                <td>{{partner.name}}</td>
                                <td>{{partner.phone}}</td>
                                <td>{{partner.email}}</td>
                                <td>{{partner.name}}</td>
                                <td>{{partner.agent_name == "undefined" ? "Нету" : partner.agent_name}}</td>
                                <td>{{partner.agent_phone == 0 ? "Нету" : partner.agent_phone}}</td>
                                <td><button class="btn delete-partner" ng-click="deletePartner(partner)">Удалить</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main><!-- ./ main -->
    </div><!-- ./ wrapper -->
    <!-- add partner modal -->
    <div class="modal fade add-partner-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить партнера</h5>
                    <button class="close" data-dismiss="modal">
                        <span><i class="pe-7s-close"></i></span>
                    </button>
                </div><!-- ./ modal-header -->
                <div class="modal-body">
                    <form autocomplete="off" ng-submit="addPartner()">
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="partner_name" placeholder="Название партнера (организации)" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" ng-model="partner_phone" placeholder="Телефон" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" ng-model="partner_email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" ng-model="category_id" required>
                                <option value="" disabled selected>Категория</option>
                                <option ng-repeat="category in categories" value="{{category.id}}">{{category.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="agent_name" placeholder="Представитель">
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" ng-model="agent_phone" placeholder="Тел. представителя">
                        </div>
                        <button class="btn cancel-button" data-dismiss="modal">Отмена</button>
                        <button class="btn save-button" type="submit">Добавить</button>
                    </form>
                </div><!-- ./ modal-body -->
            </div>
        </div>
    </div>
    <!-- ./ add partner modal -->
    <!--add user modal -->
    <div class="modal fade add-user-modal" ng-include="_templates.addUserModal"></div>
    <!-- ./ add user modal -->
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