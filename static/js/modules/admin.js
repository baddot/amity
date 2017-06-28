const defineDependencies = dependencies => {
    if (Array.isArray(dependencies)) {
        dependencies.forEach(dependency => {
            typeof dependency === "undefined" ? window.dependency = dependency : dependency;
        });
    }
};

const showError = (string, delay) => {
    if (typeof string === "string") {
        new Notyf({
            delay: delay
        }).alert(string);
    }
};

const showSuccess = (string, delay)  => {
    if (typeof string === "string") {
        new Notyf({
            delay: delay
        }).confirm(string);
    }
};

const app = angular.module("Firegular", []);

app.controller("FiregularController", $scope => {
    window.document.title = "CRM | Firegular";

    $scope.current_dollar = window.localStorage.getItem("dollar");
    $scope.current_ruble = window.localStorage.getItem("ruble");

    $scope.config = {
        headers: {
            "Content-Type": "application/x-www-form-urlencoded;charset=utf-8;"
        }
    };

    $scope._templates = {
        sidebar: "/templates/sidebar.html",
        addUserModal: "/templates/add-user-modal.html",
        profileSettingsModal: "/templates/profile-settings-modal.html"
    };

    $scope.initSystem = function() {
        setTimeout(function() {
            $(".loader").fadeOut(function() {
                $(this).css("display", "none");
            });
        }, 300);

        setTimeout(function() {
            $(".wrapper").fadeIn(function() {
                $(this).css("display", "flex");
            });
        }, 400);

        $(() => {
            $("[data-toggle=tooltip]").tooltip();
        });
    };

    $scope.setCurrency = () => {
        $scope.current_dollar = $scope.current_dollar_model.trim();
        $scope.current_ruble = $scope.current_ruble_model.trim();

        if (typeof $scope.current_dollar !== "undefined" && typeof $scope.current_ruble !== "undefined") {
            window.localStorage.setItem("dollar", $scope.current_dollar);
            window.localStorage.setItem("ruble", $scope.current_ruble);

            if (!_.isEmpty(window.localStorage.getItem("dollar")) && !_.isEmpty(window.localStorage.getItem("ruble"))) {
                $(".change-currency-modal").modal("hide");
                showSuccess("Валюта установлена", 5000);
            }
        }
    };
});

app.factory("CRM", ["$http", "$q", ($http, $q) => {
    const getData = url => {
        const defer = $q.defer();
        $http.get(url).then(function success(_res) {
            defer.resolve(_res.data);
        });
        return defer.promise;
    };

    const postData = (url, params, config) => {
        const defer = $q.defer();
        $http.post(url, params, config).then(function success(_res) {
            defer.resolve(_res.data);
        });
        return defer.promise;
    };

    return {
        getData: getData,
        postData: postData
    };
}]);


app.controller("AddUserController", ["$scope", "CRM", ($scope, CRM) => {
    $scope.addUser = () => {
        $scope.params = {
            username: $scope.username,
            password: $scope.password
        };
        CRM.postData("/user/add-user", $scope.params, $scope.config).then(_data => {
            if (Boolean(_data) === true) {
                $(".add-user-modal").modal("hide");
                showSuccess("Новый пользователь успешно добавлен!", 5000);
            } else {
                $(".add-user-modal").modal("hide");
                showError("Ошибка!", 5000);
            }
        });
    };
}]);

app.controller("AllUsersController", ["$scope", "CRM", ($scope, CRM) => {
    $scope.users = [];

    $scope.getAllUsers = () => {
        CRM.getData("/user/get-all-users").then(_data => {
            _.isEmpty($scope.users) ? $scope.users = _data : null;
        });
    };

    $scope.deleteUser = _user => {
        if (_.isObject(_user)) {
            $scope.params = {
                id: _user.id
            };
            CRM.postData("/user/delete-user", $scope.params, $scope.config).then(_data => {
                if (Boolean(_data) === true) {
                    $scope.users.splice($scope.users.indexOf(_user), 1);
                    showSuccess("Пользователь удален!", 5000);
                }
            });
        }
    };
}]);

app.controller("BalanceController", ["$scope", "CRM", ($scope, CRM) => {
    $scope.nal_usd = $scope.nal_uah = $scope.nal_rub = $scope.b_nal_pb = $scope.b_nal_qiwi = $scope.b_nal_wmz = $scope.b_nal_wmr = undefined;

    CRM.getData("/user/get-cash").then(_data => {
        if (_.isObject(_data)) {
            $scope.nal_usd = _data.nal_usd;
            $scope.nal_uah = _data.nal_uah;
            $scope.nal_rub = _data.nal_rub;
            $scope.b_nal_pb = _data.b_nal_pb;
            $scope.b_nal_qiwi = _data.b_nal_qiwi;
            $scope.b_nal_wmz = _data.b_nal_wmz;
            $scope.b_nal_wmr = _data.b_nal_wmr;
        }
    });
}]);

app.controller("ConvertController", []);

app.controller("ExpensesController", ["$scope", "CRM", ($scope, CRM) => {
    $scope.expenses = $scope.payment_forms = $scope.categories = $scope.subcategories = [];

    CRM.getData("/user/get-expenses").then(_data => {
        _.isEmpty($scope.expenses) ? $scope.expenses = _data : null;
    });

    CRM.getData("/user/cash/get-payment-forms").then(_data => {
        _.isEmpty($scope.payment_forms) ? $scope.payment_forms = _data : null;
    });

    CRM.getData("/user/get-categories").then(_data => {
        _.isEmpty($scope.categories) ? $scope.categories = _data : null;
    });

    CRM.getData("/user/get-subcategories").then(_data => {
        _.isEmpty($scope.subcategories) ? $scope.subcategories = _data : null;
    });

    $(() => {
        $(".datepicker").datepicker({
            format: "DD.MM.YYYY",
            autoHide: false
        });
    });

    $scope.addExpense = () => {
        $scope.params = {
            expense_name: $scope.expense_name,
            expense_sum: $scope.expense_sum,
            payment_form_id: $scope.payment_form_id,
            expense_date: $scope.expense_date,
            subcategory_id: $scope.subcategory_id
        };
        CRM.postData("/user/add-expense", $scope.params, $scope.config).then(_data => {
            if (Boolean(_data) === true) {
                $(".add-expense-modal").modal("hide");
                showSuccess("Расход успешно добавлен, перезагрузите страницу!", 5000);
            } else {
                $(".add-expense-modal").modal("hide");
                showError("Ошибка!", 5000);
            }
        });
    };
}]);

app.controller("IncomesController", ["$scope", "CRM", ($scope, CRM) => {
    $scope.incomes = $scope.payment_forms = $scope.partners = [];

    CRM.getData("/user/get-incomes").then(_data => {
        _.isEmpty($scope.incomes) ? $scope.incomes = _data : null;
    });

    CRM.getData("/user/cash/get-payment-forms").then(_data => {
        _.isEmpty($scope.payment_forms) ? $scope.payment_forms = _data : null;
    });

    CRM.getData("/user/get-partners").then(_data => {
        _.isEmpty($scope.partners) ? $scope.partners = _data : null;
    });

    $scope.orderBy = _filter => {
        $scope.filter = _filter;
    };

    $(() => {
        $(".datepicker").datepicker({
            format: "DD.MM.YYYY",
            autoHide: false
        });
    });

    $scope.addIncome = () => {
        $scope.params = {
            income_name: $scope.income_name,
            income_sum: $scope.income_sum,
            payment_form_id: $scope.payment_form_id,
            income_date: $scope.income_date,
            partner_id: $scope.partner_id
        };
        CRM.postData("/user/add-income", $scope.params, $scope.config).then(_data => {
            if (Boolean(_data) === true) {
                $(".add-income-modal").modal("hide");
                showSuccess("Доход успешно добавлен, перезагрузите страницу!", 5000);
            } else {
                $(".add-income-modal").modal("hide");
                showError("Ошибка!", 5000);
            }
        });
    };
}]);

app.controller("PartnerController", ["$scope", "CRM", ($scope, CRM) => {
    $scope.partners = $scope.categories = [];

    CRM.getData("/user/get-partners").then(_data => {
        _.isEmpty($scope.partners) ? $scope.partners = _data : null;
    });

    CRM.getData("/user/get-categories").then(_data => {
        _.isEmpty($scope.categories) ? $scope.categories = _data : null;
    });

    $scope.addPartner = () => {
        $scope.params = {
            partner_name: $scope.partner_name,
            partner_phone: $scope.partner_phone,
            partner_email: $scope.partner_email,
            category_id: $scope.category_id,
            agent_name: $scope.agent_name,
            agent_phone: $scope.agent_phone
        };
        CRM.postData("/user/add-partner", "partner_name=" + $scope.params, $scope.config).then(_data => {
            if (Boolean(_data) === true) {
                $(".add-partner-modal").modal("hide");
                showSuccess("Новый партнер успешно добавлен, перезагрузите страницу!", 5000);
            } else {
                $(".add-partner-modal").modal("hide");
                showError("Ошибка!", 5000);
            }
        });
    };

    $scope.deletePartner = _partner => {
        $scope.params = { partner_id: $scope.partner_id };
        CRM.postData("/user/delete-partner", $scope.params, $scope.config).then(_data => {
            if (Boolean(_data) === true) {
                $scope.partners.splice($scope.partners.indexOf(_partner), 1);
                showSuccess("Запрос прошел успешно!", 5000);
            } else {
                showError("Ошибка сервера!", 5000);
            }
        });
    };
}]);

app.controller("ProfileSettingsController", ["$scope", "CRM", ($scope, CRM) => {
    $scope.username = undefined;

    CRM.getData("/user/get-username").then(_data => {
        _data = _data.replace(/"/g, "");
        $scope.username = "Логин: " + _data;
    });

    $scope.updateProfile = () => {
        $scope.params = {
            old_password: $scope.old_password,
            new_password: $scope.new_password
        };
        CRM.postData("/user/update-profile", $scope.params, $scope.config).then(_data => {
            Boolean(_data) === true ? showSuccess("Пароль изменен!", 5000) : showError("Ошибка сервера!", 5000);
        });
    };
}]);

app.controller("ThesaurusController", ["$scope", "CRM", ($scope, CRM) => {
    $scope.categories = $scope.subcategories = [];

    CRM.getData("/user/get-categories").then(_data => {
        _.isEmpty($scope.categories) ? $scope.categories = _data : null;
    });

    CRM.getData("/user/get-subcategories").then(_data => {
        _.isEmpty($scope.subcategories) ? $scope.subcategories = _data : null;
    });

    $scope.addCategory = () => {
        $scope.params = { category_name: $scope.category_name };
        CRM.postData("/user/add-category", $scope.params, $scope.config).then(_data => {
            if (Boolean(_data) === true) {
                $(".add-category-modal").modal("hide");
                showSuccess("Категория успешно добавлена!", 5000);
            } else {
                $(".add-category-modal").modal("hide");
                showError("Серверная ошибка!", 5000);
            }
        });
    };

    $scope.addSubcategory = () => {
        $scope.params = {
            subcategory_name: $scope.subcategory_name,
            category_id: $scope.category_id
        };
        CRM.postData("/user/add-subcategory", $scope.params, $scope.config).then(_data => {
            if (Boolean(_data) === true) {
                $(".add-subcategory-modal").modal("hide");
                showSuccess("Подкатегория успешно добавлена!", 5000);
            } else {
                $(".add-subcategory-modal").modal("hide");
                showError("Серверная ошибка!", 5000);
            }
        });
    };

    $scope.deleteCategory = _category => {
        $scope.params = { category_id: $scope.category_id };
        CRM.postData("/user/delete-category", $scope.params, $scope.config).then(_data => {
            if (Boolean(_data) === true) {
                $scope.categories.splice($scope.categories.indexOf(_category), 1);
                showSuccess("Категория успешно удалена!", 5000);
            } else {
                showError("Серверная ошибка!", 5000);
            }
        });
    };

    $scope.deleteSubcategory = _subcategory => {
        $scope.params = { subcategory_id: $scope.subcategory_id };
        CRM.postData("/user/delete-subcategory", $scope.params, $scope.config).then(_data => {
            if (Boolean(_data) === true) {
                $scope.subcategories.splice($scope.subcategories.indexOf(_subcategory), 1);
                showSuccess("Подкатегория успешно удалена!", 5000);
            } else {
                showError("Серверная ошибка!", 5000);
            }
        });
    };
}]);

app.controller("LogoutController", ["$scope", "CRM", ($scope, CRM) => {
    $scope.logout = () => {
        CRM.postData("/user/logout", null, $scope.config).then(_data => {
            Boolean(_data) === true ? window.location.href = "/" : null;
        });
    };
}]);

document.addEventListener("DOMContentLoaded", () => defineDependencies([angular, moment, _, Notyf]));