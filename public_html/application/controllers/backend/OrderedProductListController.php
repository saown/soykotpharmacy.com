<?php
class OrderedProductListController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata('customer_id')){
            redirect(site_url('login_admin'));
        }

        $this->load->model('orderedProductListModel', 'OPLModel');
    }
    public function index(){
        $productList = $this->OPLModel->groupby(date('y-m-d'));
        $data = ['productList' => $productList];
        $this->load->view('backend/orderedProductList', $data);
    }
}