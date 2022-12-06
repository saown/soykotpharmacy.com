<?php
class Contact_us_frontend extends CI_Controller{
    public function __construct()
    {

        parent::__construct();
        $this->session->set_userdata('csrf_token', md5(rand()));
    }
    public function index(){
        $styleFileLink = [
            site_url('assets/bootstrap/css/bootstrap.min.css'),
            site_url('assets/front-end/css/style.css'),
        ];

        $scriptFileLink = [
            site_url('assets/jquery/jquery-3.6.0.js'),
            site_url('assets/sweetalert2/sweetalert2.js'),
            site_url('assets/js/frontend-main.js'),
            site_url('assets/bootstrap/js/bootstrap.min.js'),
            site_url('assets/front-end/js/custom/contactus.js')
        ];

        $data = [
            'styleFileLink' => $styleFileLink,
            'scriptFileLink' => $scriptFileLink
        ];

        $this->load->view('frontend/contactus',$data);
    }

    public function sendMessage(){
        $data = ['status' => 0, 'message' => 'Invalid Request'];
        $this->form_validation->set_rules('name','name','required');
        $this->form_validation->set_rules('email','email','required|valid_email');
        $this->form_validation->set_rules('message','message','required');
        if ($this->form_validation->run() === false){
            $data = ['status' => 0, 'message' => validation_errors()];
        }else {
            $insertData = [
                'name' => filter($this->input->post('name')),
                'email' => filter($this->input->post('email')),
                'message' => filter($this->input->post('message')),

            ];
            if ($this->core_model->insertData('contactUsMessage', $insertData)) {
                $data = ['status' => 1, 'message' => 'Message is send successfully'];
            }
        }

        $this->core_model->outPutData($data);
    }
}
