<?php defined("BASEPATH") OR exit("No direct script access allowed");

$route["404_override"] = "";
$route["translate_uri_dashes"] = FALSE;
// Global routes
$route["default_controller"] = "IndexController";

// User routes
$route["user"] = "UserController";
$route["user/logout"] = "AuthController/logout";
$route["user/add-user"] = "UserController/addUser";
$route["user/all-users"] = "UserController/showAllUsersPage";
$route["user/get-all-users"] = "UserController/getAllUsers";
$route["user/delete-user"] = "UserController/deleteUser";
$route["user/update-profile"] = "UserController/updateProfile";
$route["user/get-username"] = "UserController/getUsername";

// User cash + currency
$route["user/balance"] = "UserController/showBalancePage";
$route["user/cash/get-current-rate"] = "CashController/getCurrentRate";
$route["user/cash/get-payment-forms"] = "CashController/getPaymentForms";

// Transactions
$route["user/get-cash"] = "CashController/getCash";

$route["user/incomes"] = "CashController/showIncomesPage";
$route["user/get-incomes"] = "CashController/getIncomes";
$route["user/add-income"] = "CashController/addIncome";
$route["user/delete-income"] = "CashController/deleteIncome";

$route["user/expenses"] = "CashController/showExpensesPage";
$route["user/get-expenses"] = "CashController/getExpenses";
$route["user/add-expense"] = "CashController/addExpense";
$route["user/delete-expense"] = "CashController/deleteExpense";

// User partners + services
$route["user/partners"] = "UserController/showPartnersPage";
$route["user/get-partners"] = "UserController/getPartners";
$route["user/add-partner"] = "UserController/addPartner";
$route["user/delete-partner"] = "UserController/deletePartner";

// User categories
$route["user/thesaurus"] = "UserController/showThesaurusPage";
$route["user/get-categories"] = "UserController/getCategories";
$route["user/get-subcategories"] = "UserController/getSubcategories";
$route["user/add-category"] = "UserController/addCategory";
$route["user/add-subcategory"] = "UserController/addSubcategory";
$route["user/delete-category"] = "UserController/deleteCategory";
$route["user/delete-subcategory"] = "UserController/deleteSubcategory";

// Auth routes [login, register, logout]
$route["login"] = "AuthController/login";