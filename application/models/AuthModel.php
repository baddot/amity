<?php defined("BASEPATH") or exit();
/**
 * @property  mixed db
 */
class AuthModel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function userExists($username, $password) {
        $this->db->where("username", $username)->where("password", $password);
        return $this->db->count_all_results("users");
    }

    public function register($username, $password) {
        return $this->db->query("INSERT INTO users VALUES (NULL, '$username', '$password')");
    }

    public function getUserId($username, $password) {
        $result = $this->db->select("id")->from("users")->where("username", $username)->where("password", $password)->limit(1)->get()->row();
        return $result->id;
    }
}