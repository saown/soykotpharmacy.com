<?php
class Home_controller extends CI_Controller{

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
            site_url('assets/js/frontend-main.js'),
            site_url('assets/sweetalert2/sweetalert2.js'),
            site_url('assets/bootstrap/js/bootstrap.min.js'),
            site_url('assets/js/custom/frontend/home.js'),
            site_url('assets/pagination/pagination.js'),
        ];

        $pagination = $this->core_model->fetch_data('settings',['name' => 'pagination'])[0]->value;

        $config = [
            'base_url' => site_url('page'),
            'per_page' => (int)$pagination,
            'total_rows' => $this->db->count_all('products'),
            'num_links' => 5,
            'use_page_numbers' => true,
            'full_tag_open' => "<ul class='pagination  justify-content-center'>",
            'full_tag_close' => '</ul>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'cur_tag_open' => "<li><a class='active'>",
            'cur_tag_close' => "</a></li>",
            'prev_link' => "Prev",
            'prev_tag_open'=>"<li>",
            'prev_tag_close'=>"</li>",
            'next_link' => "Next",
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
        ];
        $this->pagination->initialize($config);
        if ($this->uri->segment(2) != ''){
            $offset = ($this->uri->segment(2) - 1)*(int)$pagination;
        }else{
            $offset = 0;
        }
        $productList = $this->core_model->pagination_fetch_data('products',$pagination,$offset,['status' => 1]);
        $data = [
            'styleFileLink' => $styleFileLink,
            'scriptFileLink' => $scriptFileLink,
            'productList' => $productList,
            'pagination' => $pagination,
        ];
        
        $this->load->view('frontend/home',$data);
    }

    public function searchBox(){
        $data = ['status' => 0, 'message' => 'Invalid request'];
        $search = filter($this->input->post('searchValue'));
        if (!empty($search)){
            $searchValue = $this->core_model->searchBox('products', 'brand_name', $search);
            if ($searchValue){
                $data = ['status' => 1, 'searchValue' => $searchValue];
            }else{
                $data = ['status' => 0, 'message' => 'Your search is not match.'];
            }
        }

        $this->core_model->outPutData($data);
    }

    public function searchProducts($name, $id=null){
        $result = null ;

        $name = explode("%20", $name);
        $name = join(" ", $name);
        $name = explode('_',$name);
        $name = str_replace($name[1], '('.$name[1].')', $name);
        $name = join('', $name);
        $styleFileLink = [
            site_url('assets/bootstrap/css/bootstrap.min.css'),
            site_url('assets/front-end/css/style.css'),
        ];

        $scriptFileLink = [
            site_url('assets/jquery/jquery-3.6.0.js'),
            site_url('assets/js/frontend-main.js'),
            site_url('assets/sweetalert2/sweetalert2.js'),
            site_url('assets/bootstrap/js/bootstrap.min.js'),
            site_url('assets/js/custom/frontend/home.js'),
            site_url('assets/pagination/pagination.js'),
        ];

        if ($id != null ){
            $result = $this->core_model->fetch_data('products', ['brand_name' => $name, 'id' => $id, 'status' => 1]);
        }else{
            if ($name != null) {
               $result = $this->core_model->searchBox('products', 'brand_name', $name);
            }
        }
        $data = [
            'productList' => $result,
            'styleFileLink' => $styleFileLink,
            'scriptFileLink' => $scriptFileLink,
        ];


        if ($result) {
            return $this->load->view('frontend/singleProduct', $data);
        }else {
            return redirect(site_url());
        }

    }

    public function createCart(){
        $data = ['status' => 0, 'message' => 'Invalid request'];
        $id = filter($this->input->post('id'));
        $price = filter($this->input->post('price'));
        $qtyType = $this->input->post('qtyType');
        $qty = filter($this->input->post('qty'));
        $name = filter($this->input->post('name'));
        $name = str_replace('(',' ', $name);
        $name = str_replace(')',' ', $name);


        $cartData = [
            'id' => rand(),
            'pid' => $id,
            'qty' => $qty,
            'qtyType' => $qtyType,
            'price' => $price,
            'name' => $name,
        ];


        if ($this->session->has_userdata('cart_contents')){

            $check = false;

            foreach ($this->cart->contents() as $item){

                if ($item['pid'] == $id && $item['price'] == $price){

                    $updateCart = [
                        'rowid' => $item['rowid'],
                        'qty'   => $qty
                    ];

                    if($this->cart->update($updateCart)) {

                        $check = true;
                        $data = ['status' => 2, 'message' => ' quantity is updated.'];

                    }

                }

            }
            if ($check === false){

                $this->cart->insert($cartData);
                $data = ['status' => 1, 'countItems' => count($this->cart->contents())];

            }
        }else{

            if ($this->cart->insert($cartData)) {

                $data = ['status' => 1, 'countItems' => count($this->cart->contents())];

            }
        }


        $this->core_model->outPutData($data);
    }

}