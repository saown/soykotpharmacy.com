<?php
class Cart_controller extends CI_Controller{

    private mixed $delivery_table;
    private mixed $discount_table;
    public function __construct(){

        parent::__construct();
        $this->session->set_userdata('csrf_token', md5(rand()));

        $this->delivery_table = $this->core_model->fetch_data('settings',['name' => 'delivery_fee'])[0];
        $this->discount_table = $this->core_model->fetch_data('settings',['name' => 'discount'])[0];

    }

    private function discount(): array
    {

        if (count($this->cart->contents()) > 0) {

            $amount = [];

            foreach ($this->cart->contents() as $item){

                $amount[] = $item['subtotal'];

            }

           $subTotal = array_sum($amount);

            if (($subTotal * number_format($this->delivery_table->decimal_value,4)) < 50){
                $delivery_fee = number_format(50,2);
            }else{
                $delivery_fee = $subTotal * number_format($this->delivery_table->decimal_value,4);
            }

            if ($subTotal >= $this->discount_table->value) {

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
                $this->session->unset_userdata("discount");
                $data = [
                    'grandTotal' => number_format($subTotal + $delivery_fee,2),
                    'discount' => 0,
                    "discountPrice" => 0,
                    "delivery_fee" => number_format($delivery_fee,2),
                    'subTotal'=> $subTotal
                ];
            }

        }else{
            $this->session->unset_userdata("discount");
            $data = [
                'grandTotal' => 0,
                'discount' => 0,
                'discountPrice' => 0,
                'delivery_fee' => 0,
                'subTotal' => 0
            ];
        }
        return $data;
    }

    public function index(){


        $styleFileLink = [
            site_url('assets/bootstrap/css/bootstrap.min.css'),
            site_url('assets/front-end/css/style.css'),
        ];

        $scriptFileLink = [
            site_url('assets/jquery/jquery-3.6.0.js'),
            site_url('assets/sweetalert2/sweetalert2.js'),
            site_url('assets/bootstrap/js/bootstrap.min.js'),
            site_url('assets/js/frontend-main.js'),
            site_url('assets/js/custom/frontend/cart.js'),
        ];

        $data = [
            'styleFileLink' => $styleFileLink,
            'scriptFileLink' => $scriptFileLink,
            'cartItems' => $this->cart->contents(),
            'subTotal' =>  $this->discount()['subTotal'],
            'delivery_fee' => $this->discount()["delivery_fee"],
            "discount" => $this->discount()['discount'],
            "discountPrice" => $this->discount()['discountPrice'],
            "grandTotal" => $this->discount()['grandTotal'],
        ];

        $this->load->view('frontend/item',$data);
    }

    public function updateCart(){

        $data = ['status' => 0, 'message' => 'Invalid request'];

        $rowID = filter($this->input->post('rowID'));
        $qty = filter($this->input->post('qty'));

        $updateCart = [
            'rowid' => $rowID,
            'qty'   => $qty
        ];

        if ($this->cart->update($updateCart)){

            $updateDeliveryFee = $this->discount()['delivery_fee'];
            $discount = $this->discount()['discount'];
            $subTotal = $this->discount()['subTotal'];
            $discountPrice = $this->discount()['discountPrice'];
            $grandTotal = $this->discount()['grandTotal'];
            $totalPrice = $this->cart->contents()[$rowID]['subtotal'];
            $nameOfBrand = $this->cart->contents()[$rowID]['name'];

            $data = [
                'status' => 1 ,
                'message' => '`'.$nameOfBrand.'` quantity has been updated.',
                'totalPrice' => $totalPrice,
                'subTotal' => $subTotal,
                'delivery_fee' => $updateDeliveryFee,
                'grandTotal' => $grandTotal,
                'discount' => $discount,
                'discountPrice' =>  $discountPrice,
            ];
        }
        $this->core_model->outPutData($data);
    }

    public function deleteCart(){

        $data = ['status' => 0, 'message' => "Invalid request"];

        $rowID = filter($this->input->post('rowID'));

        if ($this->cart->remove($rowID)){

            $subTotal = $this->discount()['subTotal'];
            $grandTotal = $this->discount()['grandTotal'];
            $data = [
                'status' => 1,
                'message' => 'Successfully removed your one item',
                'countItem' => count($this->cart->contents()),
                'delivery_fee' => $this->discount()["delivery_fee"],
                'subTotal' => $subTotal,
                'grandTotal' => $grandTotal,
                'discount' => $this->discount()['discount'],
                'discountPrice' => $this->discount()['discountPrice'],
            ];
        }

        $this->core_model->outPutData($data);
    }

    public function checkOutCheck(){
        
        if($this->session->has_userdata('client_id')){
            
            if(count($this->cart->contents()) > 0){
                
                $data = ['status' => 1 , 'message' => site_url('placeOrder')];
                
            }else{
                
                $data = ['status' => 0, 'message' => "Add product cart first."];
                
            }
        }else{
            
            $data = ['status' => 0,'message' => "You have to login first or create your acoount."];
            
        }
        
        $this->core_model->outPutData($data);
        
    }

}