<?php defined("BASEPATH") or exit();

class AdminModel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function loadUsers() {
        $this->db->select("*")->from("users");
        $result = $this->db->get();
        return $result->result_array();
    }

    public function deleteUser($user_id) {
        return $this->db->query("DELETE FROM users WHERE id=$user_id");
    }

    public function updateProfile($new_password, $user_id) {
        return $this->db->query("UPDATE users SET password='$new_password' WHERE id=$user_id");
    }

    public function getPartners() {
        $result = $this->db->query("SELECT partners.id, partners.name, partners.phone, partners.email, partners.agent_name, partners.agent_phone, categories.name FROM partners, categories WHERE partners.category_id=categories.id");
        $data = array();
        foreach ($result->result_array() as $row) {
            array_push($data, $row);
        }
        return $data;
    }

    public function addPartner($partner_name, $partner_phone, $partner_email, $category_id, $agent_name, $agent_phone) {
        return $this->db->query("INSERT INTO partners VALUES (NULL, '$partner_name', '$partner_phone', '$partner_email', $category_id, '$agent_name', '$agent_phone')");
    }

    public function deletePartner($partner_id) {
        return $this->db->query("DELETE FROM partners WHERE id=$partner_id");
    }

    public function getCategories() {
        $result = $this->db->query("SELECT * FROM categories");
        $data = array();
        foreach ($result->result_array() as $row) {
            array_push($data, $row);
        }
        return $data;
    }

    public function getSubcategories() {
        $result = $this->db->query("SELECT subcategories.id, subcategories.name, categories.name AS category_name FROM subcategories, categories WHERE subcategories.category_id=categories.id");
        $data = array();
        foreach ($result->result_array() as $row) {
            array_push($data, $row);
        }
        return $data;
    }

    public function addCategory($category_name) {
        return $this->db->query("INSERT INTO categories VALUES (NULL, '$category_name')");
    }

    public function addSubcategory($subcategory_name, $category_id) {
        return $this->db->query("INSERT INTO subcategories VALUES (NULL, '$subcategory_name', $category_id)");
    }

    public function deleteCategory($category_id) {
        if ($this->db->query("DELETE FROM categories WHERE id=$category_id")) {
            $delete_subcategories = $this->db->query("DELETE FROM subcategories WHERE category_id=$category_id");
            return $delete_subcategories;
        } else {
            return false;
        }
    }

    public function deleteSubcategory($subcategory_id) {
        return $this->db->query("DELETE FROM subcategories WHERE id=$subcategory_id");
    }
}