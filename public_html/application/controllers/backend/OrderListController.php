<?php
class OrderListController extends CI_Controller{
    private $discount_table;
    private $delivery_table;
    function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('customer_id')){
            redirect(site_url('login_admin'));
        }
        $this->delivery_table = $this->core_model->fetch_data("settings",['name' => 'delivery_fee'])[0];
        $this->discount_table = $this->core_model->fetch_data("settings",['name' => 'discount'])[0];
    }


    private function discount($id) {

        $subTotal = $this->core_model->fetch_data('productOrderLists', ['id' => $id])[0]->total_price;

        if (($subTotal * number_format($this->delivery_table->decimal_value,4)) < 50){

            $delivery_fee = number_format(50,2);

        }else{

            $delivery_fee = $subTotal * number_format($this->delivery_table->decimal_value,4);

        }

        if($subTotal >= $this->discount_table->value){

            $grand = ($subTotal / 100) * $this->discount_table->decimal_value;
            $grandTotal =(($subTotal - $grand) + $delivery_fee);
            $this->session->set_userdata("discount", 1);

            $data = [
                'grandTotal' => number_format($grandTotal,2),
                'discount' => number_format($this->discount_table->decimal_value,2),
                'discountPrice' => number_format($grand,2),
                "delivery_fee" => number_format($delivery_fee,2),
                'subTotal'=> $subTotal
            ];
        }else{
            $data = [
                'grandTotal' => number_format(($subTotal + $delivery_fee),2),
                "delivery_fee" => number_format($delivery_fee,2),
                'discount' => 0,
                'discountPrice' => 0,
                'subTotal'=> $subTotal
            ];
        }
        return $data;
    }

    public function index(){
        $data = [
            'orderList' => $this->core_model->fetch_data('productOrderLists',['orderDate' => date('Y-m-d')]),
            'orderScript' => [
                site_url('assets/backend/js/custom/orderList.js')
            ],
        ];
        $this->load->view('backend/orderList',$data);
    }

    public function orderDelete(){
        $data = ['status' => 0, 'message' => 'Invalid Request'];
        $id = $this->input->post('id');

        if ($id != null){
            if ($this->core_model->deleteData('productOrderLists', ['id' => $id])){
               $data = ['status' => 1, 'message' => 'Order is deleted successfully'];
            }
        }else{
            $data = ['status' => 1, 'message' => 'Id is empty'];
        }
        $this->core_model->outPutData($data);
    }

    public function orderChangeStatus(){
        $data = ['status' => 0, 'message' => 'Invalid Request'];
        $id = filter($this->input->post('id'));
        $value = filter($this->input->post('value'));

        if ($this->core_model->updateData('productOrderLists',['id' => $id], ['status' => $value])){
            $data = ['status' => 1, 'message' => 'Order status changed successfully'];
        }

        $this->core_model->outPutData($data);
    }

    public function viewInvoice($id){
        $orderInfo = $this->core_model->fetch_data('productOrderLists', ['id' => $id])[0];
        if ((int)$this->session->userdata('customer_status') === 500) {
            $discountPersentence = $this->discount($id)["discount"];
            $discountPrice = $this->discount($id)["discountPrice"];
            $delivery_fee = $this->discount($id)["delivery_fee"];
            $grandTotal = $this->discount($id)["grandTotal"];
            $data = [
                'productList' => $this->core_model->invoiceProductList($id),
                'orderInfo' => $orderInfo,
                'deliveryFree' => $delivery_fee,
                'discountPrice'=> $discountPrice,
                'discountPersentence'=> $discountPersentence,
                'grandTotal' => $grandTotal,
            ];
            $this->load->view('frontend/invoice', $data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }
}