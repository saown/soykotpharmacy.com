<?php
class MyOrderController extends CI_Controller{
    private $discount_table;
    private $delivery_table;
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('client_id')){
            redirect(site_url('login'));
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
        $styleFileLink = [
            site_url('assets/bootstrap/css/bootstrap.min.css'),
            site_url('assets/front-end/css/frontEndAdminStyle.css'),
        ];
        $scriptFileLink = [
            site_url('assets/jquery/jquery-3.6.0.js'),
            site_url('assets/sweetalert2/sweetalert2.js'),
            site_url('assets/bootstrap/js/bootstrap.min.js'),
            site_url('assets/front-end/js/frontendAdmin.js'),
            site_url('assets/front-end/js/custom/myOrder.js'),
        ];
        $clientOrderList = $this->core_model->fetch_data('productOrderLists', ['customerAccountId' => $this->session->userdata('client_id')], 'DESC');

        $data = [
            'styleFileLink' => $styleFileLink,
            'scriptFileLink' => $scriptFileLink,
            'clientOrderList' => $clientOrderList,
        ];


        $this->load->view("frontend/clientOrderList", $data);
    }

    public function cancelClientOrder(){
        $data = ['status' => 0, 'message' => 'Invalid Request'];
        $id = filter($this->input->post('id'));
        if ((int)$this->core_model->fetch_data('productOrderLists',['id' => $id])[0]->customerAccountId === (int)$this->session->userdata('client_id')){
            if ($this->core_model->updateData('productOrderLists', ['id' => $id], ['status' => 0])) {
                $data = ['status' => 1, 'message' => 'Your order is successfully canceled'];
            } else {
                $data = ['status' => 0, 'message' => 'Sorry some thing is wrong.'];
            }
        }
        $this->core_model->outPutData($data);
    }

    public function viewClientInvoice($id){
        $orderInfo = $this->core_model->fetch_data('productOrderLists', ['id' => $id])[0];
        if ((int)$orderInfo->customerAccountId === (int)$this->session->userdata('client_id')) {
            if ((int)$orderInfo->status != 0) {
                $discountPersentence = $this->discount($id)['discount'];
                $discountPrice = $this->discount($id)['discountPrice'];
                $delivery_fee = $this->discount($id)['delivery_fee'];
                $grandTotal = $this->discount($id)['grandTotal'];
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
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }

    public function pdfDownload($id){
        $orderInfo = $this->core_model->fetch_data('productOrderLists', ['id' => $id])[0];
        if ((int)$orderInfo->customerAccountId === (int)$this->session->userdata('client_id')) {
            if ((int)$orderInfo->status != 0) {
                $discountPersentence = $this->discount($id)['discount'];
                $discountPrice = $this->discount($id)['discountPrice'];
                $delivery_fee = $this->discount($id)['delivery_fee'];
                $grandTotal = $this->discount($id)['grandTotal'];
                $data = [
                    'productList' => $this->core_model->invoiceProductList($id),
                    'orderInfo' => $orderInfo,
                    'deliveryFree' => $delivery_fee,
                    'discountPrice'=> $discountPrice,
                    'discountPersentence'=> $discountPersentence,
                    'grandTotal' => $grandTotal,
                ];
                $this->load->view('frontend/pdfInvoice', $data);
                $html = $this->output->get_output();
                $this->load->library('pdf');
                $this->pdf->set_option('isRemoteEnabled', true);
                $this->pdf->load_html($html);
                $this->pdf->setPaper('A4');
                $this->pdf->render();
                $this->pdf->stream('invoice.pdf', ['Attachment' => true]);
            }else{
                header("HTTP/1.1 404 Not Found");
            }
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }

}