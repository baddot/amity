<?php defined("BASEPATH") or exit();
/**
 * @property mixed AuthModel
 * @property mixed AdminModel
 */
class UserController extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model("AuthModel");
        $this->load->model("AdminModel");
        if ($this->session->userdata("isAdmin") != true) {
            show_404();
        }
    }

    public function index() {
        if ($this->input->server("REQUEST_METHOD") == "GET" && $this->session->userdata("isAdmin") == true) {
            $this->load->view("admin/AdminView");
        }
    }

    public function addUser() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $username = htmlspecialchars(trim($req->username));
            $password = sha1(htmlspecialchars(trim($req->password)));

            if ($this->AuthModel->userExists($username, $password) == 0) {
                echo json_encode($this->AuthModel->register($username, $password));
            } else {
                echo json_encode(0);
            }
        }
    }

    public function showAllUsersPage() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            $this->load->view("admin/AllUsersView");
        }
    }

    public function getAllUsers() {
        echo json_encode($this->AdminModel->loadUsers());
    }

    public function deleteUser() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $user_id = intval(trim($req->id));
            echo json_encode($this->AdminModel->deleteUser($user_id) );
        }
    }

    public function getUsername() {
        echo json_encode($this->session->userdata("username"));
    }

    public function updateProfile() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $old_password = sha1(trim($req->old_password));
            $new_password = sha1(trim($req->new_password));
            echo json_encode($this->AdminModel->updateProfile($old_password, $new_password, $this->session->userdata("userId")));
        }
    }

    public function showBalancePage() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            $this->load->view("admin/BalanceView");
        }
    }

    public function showPartnersPage() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            $this->load->view("admin/PartnerView");
        }
    }

    public function getPartners() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            echo json_encode($this->AdminModel->getPartners());
        }
    }

    public function addPartner() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $partner_name = trim($req->partner_name);
            $partner_phone = trim($req->partner_phone);
            $partner_email = htmlspecialchars(trim($req->partner_email));
            $category_id = intval(trim($req->category_id));
            $agent_name = trim($req->agent_name);
            $agent_phone = intval(trim($req->agent_phone));
            echo json_encode($this->AdminModel->addPartner($partner_name, $partner_phone, $partner_email, $category_id, $agent_name, $agent_phone));
        }
    }

    public function deletePartner() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $partner_id = intval($req->partner_id);
            echo json_encode($this->AdminModel->deletePartner($partner_id));
        }
    }

    // Categories / subcategories URIs

    public function showThesaurusPage() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            $this->load->view("admin/ThesaurusView");
        }
    }

    public function getCategories() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            echo json_encode($this->AdminModel->getCategories());
        }
    }

    public function addCategory() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $category_name = trim($req->category_name);
            echo json_encode($this->AdminModel->addCategory($category_name));
        }
    }

    public function deleteCategory() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $category_id = intval($req->category_id);
            echo json_encode($this->AdminModel->deleteCategory($category_id));
        }
    }

    public function getSubcategories() {
        if ($this->input->server("REQUEST_METHOD") == "GET") {
            echo json_encode($this->AdminModel->getSubcategories());
        }
    }

    public function addSubcategory() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $subcategory_name = trim($req->subcategory_name);
            $category_id = intval($req->category_id);
            echo json_encode($this->AdminModel->addSubcategory($subcategory_name, $category_id));
        }
    }

    public function deleteSubcategory() {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $req = json_decode(file_get_contents("php://input"));
            $subcategory_id = intval($req->subcategory_id);
            echo json_encode($this->AdminModel->deleteSubcategory($subcategory_id));
        }
    }
}