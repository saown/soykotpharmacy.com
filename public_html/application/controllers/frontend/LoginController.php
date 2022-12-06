<?php
class LoginController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->has_userdata('client_id')){
            redirect(site_url('profile'));
        }
    }

    public function index(){
        $this->load->view('frontend/login');
    }

    public function loginClient(){
        $data = ['status' => 0, 'message' => 'Invalid Request'];
        $this->form_validation->set_rules('username', 'username / email address', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === false){
            $data = ['status' => 0, 'message' => validation_errors()];
        }else{
            $name = filter($this->input->post('username'));
            $password = filter($this->input->post('password'));
            $userInfo = $this->core_model->login($name, $password);
            if ($userInfo){
                if ((int)$userInfo->status) {
                    $this->session->set_userdata('client_id', $userInfo->id);
                    $this->session->set_userdata('client_username', $userInfo->username);
                    $this->session->set_userdata('client_status', $userInfo->status);
                    $data = ['status' => 1, 'message' => 'Login is successful.'];
                }else{
                    $data = ['status' => 0, 'message' => 'Username / Password is wrong.'];
                }
            }else{
                $data = ['status' => 0, 'message' => 'Username / Password is wrong.'];
            }
        }
        $this->core_model->outPutData($data);
    }

}