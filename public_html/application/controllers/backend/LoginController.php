<?php
class LoginController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->session->set_userdata('csrf_token', md5(rand()));

        if ($this->session->has_userdata('customer_id')){
            redirect(site_url('dashboard'));
        }
    }
    public function index(){
        $this->load->view('backend/login');
    }

    public function loginProcess(){

        $data = ['status' => 0, 'message' => 'Invalid request'];
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() === false){
            $data = ['status' => 0, 'message' => validation_errors()];
        }else{
            $name = filter($this->input->post('username'));
            $password = filter($this->input->post('password'));
            $loginData = $this->core_model->login($name, $password);
            if ($loginData) {
                if ((int)$loginData->status === 500) {
                    $this->session->set_userdata('customer_id', $loginData->id);
                    $this->session->set_userdata('customer_name', $loginData->username);
                    $this->session->set_userdata('customer_status', $loginData->status);
                    $data = ['status' => 1, 'message' => "Login is successful", 'customer_status' => $loginData->status];
                }else {
                    $data = ['status' => 0, 'message' => 'Username and Password is wrong'];
                }
            } else {
                $data = ['status' => 0, 'message' => 'Username and Password is wrong'];
            }

        }
        $this->core_model->outPutData($data);
    }
}