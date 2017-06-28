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
    <link rel="stylesheet" href="/static/css/thesaurus.css">
</head>
<body ng-controller="ThesaurusController" ng-init="initSystem()">
    <div class="loader">
        <img src="/static/images/puff.svg">
    </div><!-- ./ loader -->
    <div class="wrapper">
        <ul class="sidebar" ng-include="_templates.sidebar"></ul><!-- ./ sidebar -->
        <div class="top-panel">
            <h4>Firegular: справочник</h4>
            <button class="btn add" data-toggle="modal" data-target=".add-category-modal">Добавить категорию</button>
            <button class="btn add" data-toggle="modal" data-target=".add-subcategory-modal">Добавить подкатегорию</button>
            <button class="btn add" data-toggle="modal" data-target=".add-partner-modal">Добавить партнера</button>
            <div class="user">
                <i class="pe-7s-like" data-toggle="modal" data-target=".profile-settings-modal"></i>
                <span>Привет, <? echo $this->session->userdata("username") ?>!</span>
                <button class="btn logout-button" ng-controller="LogoutController" ng-click="logout()">Выйти</button>
            </div>
        </div><!-- ./ top-panel -->
        <main class="main thesaurus">
            <div class="container-fluid">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Идентификатор</th>
                                <th>Название категории</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="category in categories">
                                <td>{{category.id}}</td>
                                <td>{{category.name}}</td>
                                <td>
                                    <i class="pe-7s-trash" ng-click="deleteCategory(category)"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Идентификатор</th>
                                <th>Название подкатегории</th>
                                <th>Родительская категория</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="subcategory in subcategories">
                                <td>{{subcategory.id}}</td>
                                <td>{{subcategory.name}}</td>
                                <td>{{subcategory.category_name}}</td>
                                <td>
                                    <i class="pe-7s-trash" ng-click="deleteSubcategory(subcategory)"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main><!-- ./ main -->
    </div><!-- ./ wrapper -->
    <!-- add category modal -->
    <div class="modal fade add-category-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить категорию</h5>
                    <button class="close" data-dismiss="modal">
                        <span><i class="pe-7s-close"></i></span>
                    </button>
                </div><!-- ./ modal-header -->
                <div class="modal-body">
                    <form autocomplete="off" ng-submit="addCategory()">
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="category_name" placeholder="Название категории" required>
                        </div>
                        <button class="btn cancel-button" data-dismiss="modal">Отмена</button>
                        <button class="btn save-button" type="submit">Добавить</button>
                    </form>
                </div><!-- ./ modal-body -->
            </div>
        </div>
    </div>
    <!-- ./ add category modal -->
    <!-- add subcategory modal -->
    <div class="modal fade add-subcategory-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить подкатегорию</h5>
                    <button class="close" data-dismiss="modal">
                        <span><i class="pe-7s-close"></i></span>
                    </button>
                </div><!-- ./ modal-header -->
                <div class="modal-body">
                    <form autocomplete="off" ng-submit="addSubcategory()">
                        <div class="form-group">
                            <input type="text" class="form-control" ng-model="subcategory_name" placeholder="Подкатегория" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" ng-model="category_id" required>
                                <option value="" disabled selected>Родительская категория</option>
                                <option ng-repeat="category in categories" value="{{category.id}}">{{category.name}}</option>
                            </select>
                        </div>
                        <button class="btn cancel-button" data-dismiss="modal">Отмена</button>
                        <button class="btn save-button" type="submit">Добавить</button>
                    </form>
                </div><!-- ./ modal-body -->
            </div>
        </div>
    </div>
    <!-- ./ add subcategory modal -->
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
                    <form autocomplete="off" ng-submit="addPartner()" ng-controller="PartnerController">
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
    <!-- profile settings modal -->
    <div class="modal fade profile-settings-modal" ng-include="_templates.profileSettingsModal"></div>
    <!-- ./ profile settings modal -->
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