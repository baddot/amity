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
<body ng-controller="EventsController" ng-init="initSystem()">
    <div class="loader">
        <img src="/static/images/puff.svg">
    </div><!-- ./ loader -->
    <div class="wrapper">
        <ul class="sidebar" ng-include="_templates.sidebar"></ul><!-- ./ sidebar -->
        <div class="top-panel">
            <h4>{{title}}: события</h4>
            <button class="btn add" data-toggle="modal" data-target=".add-event-modal" ng-click="renderAddEventMap()">+ Добавить событие</button>
            <div class="user">
                <i class="pe-7s-like" data-toggle="modal" data-target=".profile-settings-modal"></i>
                <span>Привет, <? echo $this->session->userdata("username") ?>!</span>
                <button class="btn logout-button" ng-controller="LogoutController" ng-click="logout()">Выйти</button>
            </div>
        </div><!-- ./ top-panel -->
        <main class="main">
            <div class="container-fluid">
                <div class="event" ng-repeat="event in events">
                    <p>{{event.event_name}}</p>
                    <p>{{event.event_time}}</p>
                    <p><a href="javascript:void(0)" ng-click="openEvent(event)">Открыть локацию</a></p>
                </div>
            </div>
        </main><!-- ./ main -->
    </div><!-- ./ wrapper -->
    <!-- add user modal -->
    <div class="modal fade add-user-modal" ng-include="_templates.addUserModal"></div>
    <!-- ./ add user modal -->
    <!-- profile settings modal -->
    <div class="modal fade profile-settings-modal" ng-include="_templates.profileSettingsModal"></div>
    <!-- ./ profile settings modal -->
    <!-- event modal -->
    <div class="modal fade event-modal">
        <div class="modal-lg modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{event}}</h5>
                    <button class="close" data-dismiss="modal">
                        <span><i class="pe-7s-close"></i></span>
                    </button>
                </div><!-- ./ modal-header -->
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <!-- ./ event modal -->
    <!-- add event modal -->
    <div class="modal fade add-event-modal">
        <div class="modal-lg modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить событие</h5>
                    <button class="close" data-dismiss="modal">
                        <span><i class="pe-7s-close"></i></span>
                    </button>
                </div><!-- ./ modal-header -->
                <div class="modal-body">
                    <form autocomplete="off" ng-submit="addEvent()">
                        <div class="form-group">
                            <input type="text" placeholder="Название события" class="form-control" required ng-model="event_name">
                        </div>
                        <div class="form-group">
                            <input type="datetime" placeholder="Время события" class="form-control" required ng-model="event_time">
                        </div>
                        <div class="form-group">
                            <div class="map"></div>
                        </div>
                        <button class="btn cancel-button" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn add">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ./ add event modal -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcJlfrj88eBE_4byM8IAdVc1To1dnJN5g"></script>
    <script src="/static/js/bundle.min.js"></script>
    <script src="/static/js/modules/admin.js"></script>
</body>
</html>
