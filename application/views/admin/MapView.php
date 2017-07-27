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
<body ng-controller="MapController" ng-init="initSystem()">
    <div class="loader">
        <img src="/static/images/puff.svg">
    </div><!-- ./ loader -->
    <div class="wrapper" ng-init="initMap()">
        <ul class="sidebar" ng-include="_templates.sidebar"></ul><!-- ./ sidebar -->
        <div class="top-panel">
            <h4>{{title}}: геокодирование | город: {{yourCity}}</h4>
            <button class="btn add" data-toggle="modal" data-target=".add-mark-modal">+ Добавить метку</button>
            <div class="user">
                <i class="pe-7s-like" data-toggle="modal" data-target=".profile-settings-modal"></i>
                <span>Привет, <? echo $this->session->userdata("username") ?>!</span>
                <button class="btn logout-button" ng-controller="LogoutController" ng-click="logout()">Выйти</button>
            </div>
        </div><!-- ./ top-panel -->
        <main class="main map"></main><!-- ./ main -->
    </div><!-- ./ wrapper -->
    <!-- add mark modal -->
    <div class="modal fade add-mark-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить метку</h5>
                    <button class="close" data-dismiss="modal">
                        <span><i class="pe-7s-close"></i></span>
                    </button>
                </div><!-- ./ modal-header -->
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="mark_lat" placeholder="{{mark_lat}}" disabled required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="mark_lng" placeholder="{{mark_lng}}" disabled required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="mark_name" placeholder="Название метки" required>
                        </div>
                        <button class="btn cancel-button" data-dismiss="modal">Отмена</button>
                        <button class="btn add" type="submit">Добавить</button>
                    </form>
                </div><!-- ./ modal-body -->
            </div>
        </div>
    </div>
    <!-- ./ add mark modal -->
    <!--add user modal -->
    <div class="modal fade add-user-modal" ng-include="_templates.addUserModal"></div>
    <!-- ./ add user modal -->
    <!-- profile settings modal -->
    <div class="modal fade profile-settings-modal" ng-include="_templates.profileSettingsModal"></div>
    <!-- ./ profile settings modal -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcJlfrj88eBE_4byM8IAdVc1To1dnJN5g"></script>
    <script src="/static/js/bundle.min.js"></script>
    <script src="/static/js/modules/admin.js"></script>
</body>
</html>
