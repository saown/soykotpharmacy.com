<?php
class ProfileController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('client_id')){
            redirect(site_url('login'));
        }
    }

    public function index(){
        $styleFileLink = [
            site_url('assets/bootstrap/css/bootstrap.min.css'),
            site_url('assets/front-end/css/frontEndAdminStyle.css'),
        ];
        $scriptFileLink = [
            site_url('assets/jquery/jquery-3.6.0.js'),
            site_url('assets/sweetalert2/sweetalert2.js'),
            site_url('assets/bootstrap/js/bootstrap.min.js'),
            site_url('assets/front-end/js/frontendAdmin.js'),
            site_url('assets/front-end/js/custom/profile.js'),
        ];

        $client_data = $this->core_model->fetch_data('customer_accounts',['id' => (int)$this->session->userdata('client_id')])[0];

        $data = [
            'styleFileLink' => $styleFileLink,
            'scriptFileLink' => $scriptFileLink,
            'client_data' => $client_data,
        ];
        $this->load->view('frontend/profile',$data);
    }

    public function changeProfileInfo(){
        $data = ['status' => 0, 'message' => 'Invalid Request'];

        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('address_line_1', 'address line 1', 'required');
        $this->form_validation->set_rules('phone_number', 'phone number', 'required');

        if ($this->form_validation->run() === false){
            $data = ['status' => 0, 'message' => validation_errors()];
        }else{
            $id = $this->session->userdata('client_id');
            $username = $this->session->userdata('client_username');

            if ($this->core_model->fetch_data('customer_accounts',['id' => $id, 'username' => $username, 'status' => 1])){
                $updateData = [
                    'username' => filter($this->input->post('username')),
                    'email' => filter($this->input->post('email')),
                    'address_line_1' => filter($this->input->post('address_line_1')),
                    'address_line_2' => filter($this->input->post('address_line_2')),
                    'phone_number' => filter($this->input->post('phone_number')),
                ];
                if($this->core_model->updateData('customer_accounts',['id' => $id, 'status' => 1], $updateData)){
                    $data = ['status' => 1, 'message' => 'Your info is change successfully.'];
                }
            }
        }

        $this->core_model->outPutData($data);
    }

    public function changePassword(){
        $data = ['status' => 0, 'message' => 'Invalid Request.'];
        $this->form_validation->set_rules('old-pass', 'old password', 'required');
        $this->form_validation->set_rules('new-pass', 'new Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm-pass', 'confirm Password', 'required|matches[new-pass]');

        if ($this->form_validation->run() === false){
            $data = ['status' => 0, 'message' => validation_errors()];
        }else{
            $hashPassword = $this->core_model->fetch_data('customer_accounts',['id' => $this->session->userdata('client_id')])[0]->password;
            if (password_verify($this->input->post('old-pass'),$hashPassword)){
                $newPasswordHash = $this->core_model->passwordEncryption($this->input->post('confirm-pass'));
                if($this->core_model->updateData('customer_accounts', ['id' => $this->session->userdata('client_id')], ['password' => $newPasswordHash])) {
                    $data = ['status' => 1, 'message' => 'Password is changed successfully'];
                }
            }else{
                $data = ['status' => 0, 'message' => 'Your old password is wrong.'];
            }
        }

        $this->core_model->outPutData($data);
    }

    public function clientLogout(){
        $this->session->unset_userdata('billingInfo');
        $this->session->unset_userdata('shippingInfo');
        $this->session->unset_userdata('client_id');
        $this->session->unset_userdata('client_username');
        $this->session->unset_userdata('client_status');
        $data = ['status' => 1, 'message' => 'Logout successful '];
        $this->core_model->outPutData($data);
    }

}