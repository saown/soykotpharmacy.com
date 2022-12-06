<?php
class PlaceOrderController extends CI_Controller{

    private mixed $delivery_table;
    private mixed $discount_table;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('client_id')){
            redirect(site_url('login'));
        }

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
            site_url('assets/front-end/js/custom/placeOrder.js'),
        ];

        $userInfo = '';

        if ($this->session->has_userdata('client_id')) {
            $id = $this->session->userdata('client_id');
            $username = $this->session->userdata('client_username');
            $status = $this->session->userdata('client_status');
            $userInfo = $this->core_model->fetch_data('customer_accounts', ['id' => $id, 'username' => $username, 'status' => $status])[0];
            $orderInfo = [
                'shippingInfo' => [
                    'username' => $userInfo->username,
                    'email' => $userInfo->email,
                    'address_line_1' => $userInfo->address_line_1,
                    'address_line_2' => $userInfo->address_line_2,
                    'phone_number' => $userInfo->phone_number,
                    'country' => $userInfo->country,
                    'city' => $userInfo->city,
                    'post_code' => $userInfo->post_code
                ]
            ];

            $this->session->set_userdata($orderInfo);
        }

        $data = [
            'styleFileLink' => $styleFileLink,
            'scriptFileLink' => $scriptFileLink,
            'cartItems' => $this->cart->contents(),
            'userInfo' => $userInfo,
            'grandTotal' => $this->discount()['grandTotal'],
            'discount' => $this->discount()['discount'],
            'discountPrice' => $this->discount()['discountPrice'],
            'delivery_fee' => $this->discount()['delivery_fee'],
            'subTotal' => $this->discount()['subTotal'],
        ];
        $this->load->view('frontend/placeOrder',$data);
    }

    public function shippingInfo(){
        $this->form_validation->set_rules('edit_shipping_name' , 'full name', 'required');
        $this->form_validation->set_rules('edit_shipping_phone_number' , 'phone number', 'required');
        $this->form_validation->set_rules('edit_shipping_address_1' , 'address 1', 'required');
        $this->form_validation->set_rules('edit_shipping_district' , 'district', 'required');
        $this->form_validation->set_rules('edit_shipping_city' , 'city', 'required');
        if($this->form_validation->run() === false){
            $data = ['status' => 0, 'message' => validation_errors()];
        }else{
            $orderInfo = [
                'shippingInfo' => [
                    'username' => filter($this->input->post('edit_shipping_name')),
                    'email' => filter($this->input->post('edit_shipping_email')),
                    'phone_number' => filter($this->input->post('edit_shipping_phone_number')),
                    'address_line_1' => filter($this->input->post('edit_shipping_address_1')),
                    'address_line_2' => filter($this->input->post('edit_shipping_address_2')),
                    'country' => filter($this->input->post('edit_shipping_district')),
                    'city' => filter($this->input->post('edit_shipping_city')),
                    'post_code' => filter($this->input->post('edit_shipping_post_code')),
                ],
            ];

            $this->session->set_userdata($orderInfo);
            $data = ['status' => 1, 'message' => 'Shipping Information is change successfully'];
        }
        $this->core_model->outPutData($data);
    }

    public function order(){
        $data = ['status' => 0, 'message' => 'Invalid Request'];
        if (!$this->session->has_userdata('client_id')){
            redirect(site_url('login'));
        }else{
            $customer_id = $this->session->userdata('client_id');

            $shippingName = $this->session->userdata('shippingInfo')['username'];
            $shippingEmail = $this->session->userdata('shippingInfo')['email'];
            $shippingPhoneNum = $this->session->userdata('shippingInfo')['phone_number'];
            $shippingAddress = $this->session->userdata('shippingInfo')['address_line_1']. '/'. $this->session->userdata('shippingInfo')['address_line_2'];
            $orderDate = date('Y-m-d');
            $deliveryDate = date('Y-m-d');
            $payment_method = 'cash on delivery';
            $itemNum = count($this->cart->contents());
            $status = 1;

            $orderInsertData = [
                'customerAccountId' => $customer_id,
                'personal_name' => $shippingName,
                'personal_email' => $shippingEmail,
                'personal_phone' => $shippingPhoneNum,
                'personal_address' => $shippingAddress,
                'shippingName' => $shippingName,
                'shippingEmail' => $shippingEmail,
                'shippingPhoneNum' => $shippingPhoneNum,
                'shippingAddress' => $shippingAddress,
                'orderDate' => $orderDate,
                'deliveryDate' => $deliveryDate,
                'payment_method' => $payment_method,
                'total_price' => $this->session->userdata('cart_contents')['cart_total'],
                'itemNum' => $itemNum,
                'status' => $status,
            ];
            $orderId = $this->core_model->insertData('productOrderLists', $orderInsertData);
            if ($orderId){
                foreach ($this->cart->contents() as $item){
                    $cartInsertData = [
                        'product_id' => $item['pid'],
                        'order_id' => $orderId,
                        'quantity_type' => $item['qtyType'],
                        'quantity' => $item['qty'],
                        'single_price' => $item['price'],
                        'status' => 1
                    ];
                    $this->core_model->insertData('cartList', $cartInsertData);
                }
                $this->session->unset_userdata('cart_contents');
                $this->session->unset_userdata('shippingInfo');
                $data = ['status' => 1, 'message' => 'Your order is placed successfully' ];
            }
        }
        $this->core_model->outPutData($data);
    }
}