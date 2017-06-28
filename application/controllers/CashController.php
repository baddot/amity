<?php defined("BASEPATH") or exit();
/**
 * @property mixed CashModel
 */
class CashController extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model("CashModel");
        if ($this->session->userdata("isAdmin") != true) {
            show_404();
        }
    }

    public function getCurrentRate() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            echo json_encode($this->CashModel->getCurrentRate());
        }
    }

    public function getPaymentForms() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            echo json_encode($this->CashModel->getPaymentForms());
        }
    }

    public function showTransactionsPage() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            $this->load->view("admin/TransactionView");
        }
    }

    public function getTransactions() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            echo json_encode($this->CashModel->getTransactions());
        }
    }

    // Transaction URIs

    public function getCash() {
        echo json_encode($this->CashModel->getCash());
    }

    public function showIncomesPage() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            $this->load->view("admin/IncomesView");
        }
    }

    public function getIncomes() {
        echo json_encode($this->CashModel->getIncomes());
    }

    public function addIncome() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $income_name = trim($req->income_name);
            $income_sum = intval(trim($req->income_sum));
            $payment_form_id = intval(trim($req->payment_form_id));
            $income_date = trim($req->income_date);
            $partner_id = intval($req->partner_id);
            echo json_encode($this->CashModel->addIncome($income_name, $income_sum, $payment_form_id, $income_date, $partner_id));
        }
    }

    public function showExpensesPage() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            $this->load->view("admin/ExpensesView");
        }
    }

    public function getExpenses() {
        echo json_encode($this->CashModel->getExpenses());
    }

    public function addExpense() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $expense_name = trim($req->expense_name);
            $expense_sum = intval($req->expense_sum);
            $payment_form_id = intval($req->payment_form_id);
            $expense_date = trim($req->expense_date);
            $subcategory_id = intval($req->subcategory_id);
            echo json_encode($this->CashModel->addExpense($expense_name, $expense_sum, $payment_form_id, $expense_date, $subcategory_id));
        }
    }
}