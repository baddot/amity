<?php defined("BASEPATH") or exit();
/**
 * @property  mixed AuthModel
 */
class AuthController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("AuthModel");
    }

    public function login() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $username = htmlspecialchars(trim($this->input->post("username")));
            $password = sha1(htmlspecialchars(trim($this->input->post("password"))));

            if ($this->AuthModel->userExists($username, $password)) {
                $this->session->set_userdata(array(
                    "userId" => $this->AuthModel->getUserId($username, $password),
                    "isAdmin" => true,
                    "username" => $username
                ));
                echo json_encode(1);
            } else {
                echo json_encode(0);
            }
        }
    }



    public function logout() {
        if ($this->session->userdata("isAdmin") && $this->session->userdata("username")) {
            $this->session->unset_userdata(array("isAdmin", "username"));
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
}
