<?php defined("BASEPATH") or exit();

class IndexController extends CI_Controller {
    function __construct() {
        parent::__construct();
        if ($this->session->userdata("isAdmin") == true) {
            redirect("/user");
        }
    }

    public function index() {
        $this->load->view("IndexView");
    }
}