<?php
class RegistrationController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->has_userdata('client_id')){
            redirect(site_url('profile'));
        }
    }
    public function index(){
        $this->load->view('frontend/registration');
    }
    public function registrationProcess(){
        $data = ['status' => 0, 'message' => 'Invalid Request'];
        $this->form_validation->set_rules('username', 'username', 'required');
        if ($this->input->post('phone_number') === '') {
            $this->form_validation->set_rules('email', 'email or phone number', 'required|valid_email');
        }else{
            $this->form_validation->set_rules('phone_number', 'phone number','required');
        }
        $this->form_validation->set_rules('address_line_1', 'address 1', 'required');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirmed_password', 'confirmed password', 'required|matches[password]');
        $this->form_validation->set_rules('district', 'district', 'required');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('post_code', 'post code', 'required');

        if($this->form_validation->run() === false){
            $data = ['status' => 0, 'message' => validation_errors()];
        }else {
            $registrationInsertData = [
                'username' => filter($this->input->post('username')),
                'email' => filter($this->input->post('email')),
                'address_line_1' => filter($this->input->post('address_line_1')),
                'address_line_2' => filter($this->input->post('address_line_2')),
                'password' => $this->core_model->passwordEncryption(filter($this->input->post('password'))),
                'phone_number' => filter($this->input->post('phone_number')),
                'district' => filter($this->input->post('district')),
                'city' => filter($this->input->post('city')),
                'post_code' => filter($this->input->post('post_code')),
                'status' => 1,
            ];

            $clientID = $this->core_model->insertData('customer_accounts', $registrationInsertData);
            if ($clientID){
                $this->session->set_userdata('client_id', $clientID);
                $this->session->set_userdata('client_username', filter($this->input->post('username')));
                $this->session->set_userdata('client_status', '1');
                $data = ['status' => 1 , 'message' => 'Login successful.'];
            }
        }


        $this->core_model->outPutData($data);
    }
}