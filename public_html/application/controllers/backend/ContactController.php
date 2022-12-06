<?php
class ContactController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata('customer_id')) {
            redirect(site_url('login_admin'));
        }

    }

    public function index(){
        $data = [
            'contactUsMessages' => $this->core_model->fetch_data('contactUsMessage'),
        ];

        $this->load->view('backend/contact', $data);
    }
}