<?php
class DashboardController extends CI_Controller{
    public function __construct()
    {

        parent::__construct();
        $this->session->set_userdata('csrf_token', md5(rand()));
        $customerStatus = $this->core_model->fetch_data('customer_accounts', ['id'=>$this->session->userdata('customer_id')])[0]->status;

        if (!$this->session->has_userdata('customer_id')){
            redirect(site_url('login_admin'));
        }
    }
    public function index(){
        $data = [
            'dashboardScript' => [
                site_url('assets/backend/js/custom/dashboard.js'),
            ]
        ];
        $this->load->view('backend/dashboard',$data);
    }

    public function logout(){

        $this->session->unset_userdata('customer_id');
        $this->session->unset_userdata('customer_name');
        $this->session->unset_userdata('customer_status');
        $this->session->unset_userdata('billingInfo');
        $this->session->unset_userdata('shippingInfo');
        $data = ['status' => 1, 'message' => 'Logout successful '];
        $this->core_model->outPutData($data);
    }


}