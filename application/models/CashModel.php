<?php defined("BASEPATH") or exit();

class CashModel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getCash() {
        $result = $this->db->query("SELECT * FROM cash");
        $data = array();
        foreach ($result->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    public function getCurrentRate() {
        $result = $this->db->query("SELECT * FROM current_rate");
        $data = array();
        foreach ($result->result_array() as $row) {
            $data = $row;
        }
        return $data;
    }

    public function getPaymentForms() {
        $result = $this->db->query("SELECT * FROM payment_forms");
        $data = array();
        foreach ($result->result_array() as $row) {
            array_push($data, $row);
        }
        return $data;
    }

    public function getIncomes() {
        $result = $this->db->query("SELECT incomes.id, incomes.name, incomes.sum, incomes.date, payment_forms.payment_form_bank_name, payment_forms.payment_form_currency, payment_forms.payment_form_name, partners.name AS partner_name FROM incomes, payment_forms, partners WHERE incomes.payment_form_id=payment_forms.payment_form_id AND incomes.partner_id=partners.id");
        $data = array();
        foreach ($result->result_array() as $row) {
            array_push($data, $row);
        }
        return $data;
    }

    public function addIncome($income_name, $income_sum, $payment_form_id, $income_date, $partner_id) {
        $result = $this->db->query("INSERT INTO incomes VALUES (NULL, '$income_name', $income_sum, $payment_form_id, '$income_date', $partner_id)");
        if ($result) {
            switch ($payment_form_id) {
                case 1: // PB
                    $cash_query = $this->db->select("b_nal_pb")->from("cash")->limit(1)->get()->row();
                    $b_nal_pb = intval($cash_query->b_nal_pb);
                    $b_nal_pb += $income_sum;
                    return $this->db->query("UPDATE cash SET b_nal_pb=$b_nal_pb");
                    break;
                case 2: // QIWI
                    $cash_query = $this->db->select("b_nal_qiwi")->from("cash")->limit(1)->get()->row();
                    $b_nal_qiwi = intval($cash_query->b_nal_qiwi);
                    $b_nal_qiwi += $income_sum;
                    return $this->db->query("UPDATE cash SET b_nal_qiwi=$b_nal_qiwi");
                    break;
                case 3: // WMZ
                    $cash_query = $this->db->select("b_nal_wmz")->from("cash")->limit(1)->get()->row();
                    $b_nal_wmz = intval($cash_query->b_nal_wmz);
                    $b_nal_wmz += $income_sum;
                    return $this->db->query("UPDATE cash SET b_nal_wmz=$b_nal_wmz");
                    break;
                case 4: // WMR
                    $cash_query = $this->db->select("b_nal_wmr")->from("cash")->limit(1)->get()->row();
                    $b_nal_wmr = intval($cash_query->b_nal_wmr);
                    $b_nal_wmr += $income_sum;
                    return $this->db->query("UPDATE cash SET b_nal_wmr=$b_nal_wmr");
                    break;
                case 5: // Наличные Грн
                    $cash_query = $this->db->select("nal_uah")->from("cash")->limit(1)->get()->row();
                    $nal_uah = intval($cash_query->nal_uah);
                    $nal_uah += $income_sum;
                    return $this->db->query("UPDATE cash SET nal_uah=$nal_uah");
                    break;
                case 6: // Наличные Р
                    $cash_query = $this->db->select("nal_rub")->from("cash")->limit(1)->get()->row();
                    $nal_rub = intval($cash_query->nal_rub);
                    $nal_rub += $income_sum;
                    return $this->db->query("UPDATE cash SET nal_rub=$nal_rub");
                    break;
                case 7: // Наличные USD
                    $cash_query = $this->db->select("nal_usd")->from("cash")->limit(1)->get()->row();
                    $nal_usd = intval($cash_query->nal_usd);
                    $nal_usd += $income_sum;
                    return $this->db->query("UPDATE cash SET nal_usd=$nal_usd");
                    break;
            }
        } else {
            return false;
        }
    }

    public function getExpenses() {
        $result = $this->db->query("SELECT expenses.id, expenses.name, expenses.sum, expenses.date, subcategories.name AS subcategory_name, categories.name AS category_name, payment_forms.payment_form_bank_name, payment_forms.payment_form_currency, payment_forms.payment_form_name FROM expenses, subcategories, categories, payment_forms WHERE expenses.payment_form_id=payment_forms.payment_form_id AND expenses.subcategory_id=subcategories.id AND categories.id=subcategories.category_id");
        $data = array();
        foreach ($result->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function addExpense($name, $sum, $payment_form_id, $date, $subcategory_id) {
        $result = $this->db->query("INSERT INTO expenses VALUES (NULL, '$name', $sum, $payment_form_id, '$date', $subcategory_id)");
        if ($result) {
            switch ($payment_form_id) {
                case 1: // PB
                    $cash_query = $this->db->select("b_nal_pb")->from("cash")->limit(1)->get()->row();
                    $b_nal_pb = intval($cash_query->b_nal_pb);
                    $b_nal_pb -= $sum;
                    return $this->db->query("UPDATE cash SET b_nal_pb=$b_nal_pb");
                    break;
                case 2: // QIWI
                    $cash_query = $this->db->select("b_nal_qiwi")->from("cash")->limit(1)->get()->row();
                    $b_nal_qiwi = intval($cash_query->b_nal_qiwi);
                    $b_nal_qiwi -= $sum;
                    return $this->db->query("UPDATE cash SET b_nal_qiwi=$b_nal_qiwi");
                    break;
                case 3: // WMZ
                    $cash_query = $this->db->select("b_nal_wmz")->from("cash")->limit(1)->get()->row();
                    $b_nal_wmz = intval($cash_query->b_nal_wmz);
                    $b_nal_wmz -= $sum;
                    return $this->db->query("UPDATE cash SET b_nal_wmz=$b_nal_wmz");
                    break;
                case 4: // WMR
                    $cash_query = $this->db->select("b_nal_wmr")->from("cash")->limit(1)->get()->row();
                    $b_nal_wmr = intval($cash_query->b_nal_wmr);
                    $b_nal_wmr -= $sum;
                    return $this->db->query("UPDATE cash SET b_nal_wmr=$b_nal_wmr");
                    break;
                case 5: // Наличные Грн
                    $cash_query = $this->db->select("nal_uah")->from("cash")->limit(1)->get()->row();
                    $nal_uah = intval($cash_query->nal_uah);
                    $nal_uah -= $sum;
                    return $this->db->query("UPDATE cash SET nal_uah=$nal_uah");
                    break;
                case 6: // Наличные Р
                    $cash_query = $this->db->select("nal_rub")->from("cash")->limit(1)->get()->row();
                    $nal_rub = intval($cash_query->nal_rub);
                    $nal_rub -= $sum;
                    return $this->db->query("UPDATE cash SET nal_rub=$nal_rub");
                    break;
                case 7: // Наличные USD
                    $cash_query = $this->db->select("nal_usd")->from("cash")->limit(1)->get()->row();
                    $nal_usd = intval($cash_query->nal_usd);
                    $nal_usd -= $sum;
                    return $this->db->query("UPDATE cash SET nal_usd=$nal_usd");
                    break;
            }
        } else {
            return false;
        }
    }
}
