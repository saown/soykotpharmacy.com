<?php
class ProductListController extends CI_Controller {
    private $customerStatus;

    public function __construct()
    {
        parent::__construct();
        $this->customerStatus = $this->core_model->fetch_data('customer_accounts', ['id'=>$this->session->userdata('customer_id')])[0]->status;

        if (!$this->session->has_userdata('customer_id')){
            redirect(site_url('login_admin'));
        }
    }

    public function index(){
        $config = [
            'base_url' => 'https://soykotpharmacy.com/productList/page',
            'per_page' => 100,
            'total_rows' => $this->db->count_all('products'),
            'use_page_numbers' => true,
            'num_links' => 5,
            'full_tag_open' => "<ul class='pagination justify-content-center'>",
            'full_tag_close' => '</ul>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'cur_tag_open' => "<li class='page-item active'><a class='page-link'>",
            'cur_tag_close' => "</a></li>",
            'prev_link' => '<i class="tf-icon bx bx-chevrons-left"></i>',
            'prev_tag_open'=>"<li class='page-item prev'>",
            'prev_tag_close'=>"</li>",
            'next_link' => '<i class="tf-icon bx bx-chevrons-right"></i>',
            'next_tag_open' => '<li class="page-item next">',
            'next_tag_close' => '</li>',
            'attributes' => ['class'=> 'page-link'],
        ];
        $this->pagination->initialize($config);
        if ($this->uri->segment(3) != ''){
            $offset = (($this->uri->segment(3) - 1) * 100);
        }else{
            $offset = 0;
        }
        $productList = $this->core_model->pagination_fetch_data('products',100,$offset,null);
        $data = [
            'productList'=>$productList,
            'pScript' => [
                site_url('assets/backend/js/custom/productList.js'),
                ],
            'count' => $this->db->count_all('products')
        ];

        $this->load->view('backend/productList', $data);
    }

    public function productDelete(){
        $data = ['status'=> 0, 'message' => 'Invalid Request'];
        $id = $this->input->post('id');
        if ((int)$this->customerStatus === 500 && $id != null){
            if($this->core_model->deleteData('products', ['id' => $id])){
                $data = ['status' => 1, 'message' => 'Product is deleted'];
            }else{
                $data = ['status' => 0, 'message' => 'Something is wrong'];
            }
        }
        $this->core_model->outPutData($data);
    }

    public function singleProduct(){
        $data = ['status' => 0, 'message' => 'Invalid request.'];
        $id = filter($this->input->post('id'));
        if ((int)$this->customerStatus === 500){
            $fetchData = $this->core_model->fetch_data('products', ['id' => $id]);
            if ($fetchData){
                $data = ['status' => 1, 'product'=> $fetchData];
            }else{
                $data = ['status' => 0, 'message' => 'Something is wrong'];
            }
        }
        $this->core_model->outPutData($data);
    }

    public function editProduct(){
        $this->form_validation->set_rules('id', 'id' , 'required');
        $this->form_validation->set_rules('brand_name', 'brand_name' , 'required');
        $this->form_validation->set_rules('brand_type', 'brand_type' , 'required');
        $this->form_validation->set_rules('brand_weight', 'brand_weight' , 'required');
        $this->form_validation->set_rules('brand_generic_name', 'brand_generic_name' , 'required');
        $this->form_validation->set_rules('brand_company_name', 'brand_company_name' , 'required');
        if ($this->form_validation->run() === false) {
            $data = ['status' => 0, 'message' => validation_errors()];
        }else {
            $id = filter($this->input->post('id'));

            $editProduct = [
                'brand_name' => filter($this->input->post('brand_name')),
                'brand_type' => filter($this->input->post('brand_type')),
                'brand_weight' => filter($this->input->post('brand_weight')),
                'brand_generic_name' => filter($this->input->post('brand_generic_name')),
                'price_type0' => filter($this->input->post('price_type0')),
                'price0' => filter($this->input->post('price0')),
                'price_type1' => filter($this->input->post('price_type1')),
                'price1' => filter($this->input->post('price1')),
                'price_type2' => filter($this->input->post('price_type2')),
                'price2' => filter($this->input->post('price2')),
                'price_type3' => filter($this->input->post('price_type3')),
                'price3' => filter($this->input->post('price3')),
                'price_type4' => filter($this->input->post('price_type4')),
                'price4' => filter($this->input->post('price4')),
                'price_type5' => filter($this->input->post('price_type5')),
                'price5' => filter($this->input->post('price5')),
            ];
            if($this->core_model->updateData('products',['id' => $id] ,$editProduct)){
                $data = ['status' => 1, 'message' => 'Your changes is save successfully.'];
            }else{
                $data = ['some'];
            }
        }
        $this->core_model->outPutData($data);
    }

    public function addNewProduct(){
        $data = ['status' => 0, 'message' => 'Invalid request.'];
        $this->form_validation->set_rules('brand_name', 'brand name' , 'required');
        $this->form_validation->set_rules('brand_type', 'brand type' , 'required');
        $this->form_validation->set_rules('brand_weight', 'brand weight' , 'required');
        $this->form_validation->set_rules('brand_generic_name', 'brand generic name' , 'required');
        $this->form_validation->set_rules('brand_company_name', 'brand company name' , 'required');
        $this->form_validation->set_rules('price0', 'price' , 'required');
        $this->form_validation->set_rules('price_type0', 'price type' , 'required');
        if ($this->form_validation->run() === false){
            $data = ['status' => 0, 'message' => validation_errors()];
        }else {
            $insertData = [
                'brand_name' => filter($this->input->post('brand_name')),
                'brand_type' => filter($this->input->post('brand_type')),
                'brand_weight' => filter($this->input->post('brand_weight')),
                'brand_generic_name' => filter($this->input->post('brand_generic_name')),
                'brand_company_name' => filter($this->input->post('brand_company_name')),
                'price0' => filter($this->input->post('price0')),
                'price1' => filter($this->input->post('price1')),
                'price2' => filter($this->input->post('price2')),
                'price3' => filter($this->input->post('price3')),
                'price4' => filter($this->input->post('price4')),
                'price5' => filter($this->input->post('price5')),
                'price_type0' => filter($this->input->post('price_type0')),
                'price_type1' => filter($this->input->post('price_type1')),
                'price_type2' => filter($this->input->post('price_type2')),
                'price_type3' => filter($this->input->post('price_type3')),
                'price_type4' => filter($this->input->post('price_type4')),
                'price_type5' => filter($this->input->post('price_type5')),
            ];
            if($this->core_model->insertData('products', $insertData)) {
                $data = ['status' => 1, 'message' => 'Add new product is done.'];
            }
        }
        $this->core_model->outPutData($data);
    }

    public function uploadCSVFile(){
        $this->load->library('csvimport');
        $csvFile = $this->csvimport->get_array($_FILES['csv_data']['tmp_name']);
        $insertCount = 0;
        foreach ($csvFile as $key => $value) {
            $insertProductData = [
                'brand_name' => $value['brand_name'],
                'brand_weight' => $value['brand_weight'],
                'brand_company_name' => $value['brand_company_name'],
                'brand_generic_name' => $value['brand_generic_name'],
                'price7' => ($value['price7'] === '')? '0.00' : $value['price7'],
                'price0' => ($value['price0'] === '')? '0.00' : $value['price0'],
                'price1' => ($value['price1'] === '')? '0.00' : $value['price1'],
                'price2' => ($value['price2'] === '')? '0.00' : $value['price2'],
                'price3' => ($value['price3'] === '')? '0.00' : $value['price3'],
                'price4' => ($value['price4'] === '')? '0.00' : $value['price4'],
                'price5' => ($value['price5'] === '')? '0.00' : $value['price5'],
                'price6' => ($value['price6'] === '')? '0.00' : $value['price6'],
                'price8' => ($value['price8'] === '')? '0.00' : $value['price8'],
                'price9' => ($value['price9'] === '')? '0.00' : $value['price9'],
                'price10' => ($value['price10'] === '')? '0.00' : $value['price10'],
                'price11' => ($value['price11'] === '')? '0.00' : $value['price11'],
                'price_type0' => $value['price_type0'],
                'price_type1' => $value['price_type1'],
                'price_type2' => $value['price_type2'],
                'price_type3' => $value['price_type3'],
                'price_type4' => $value['price_type4'],
                'price_type5' => $value['price_type5'],
                'price_type6' => $value['price_type6'],
                'price_type7' => $value['price_type7'],
                'price_type8' => $value['price_type8'],
                'price_type9' => $value['price_type9'],
                'price_type10' => $value['price_type10'],
                'price_type11' => $value['price_type11'],
                'status' => 1
            ];
            $this->core_model->insertData('products', $insertProductData);
            $insertCount++;
        }
        if ($insertCount === count($csvFile)){
            $data = ['status' => 1, 'message' => 'okk'];
        }
        $this->core_model->outPutData($data);
    }
}