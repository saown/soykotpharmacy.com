<?php
class Core_model extends CI_Model{
    private $csrf_token;
    private $send_csrf_token;

    public function __construct()
    {
        parent::__construct();
        $this->csrf_token = $this->session->userdata('csrf_token');
        $this->send_csrf_token = $this->input->post('csrf_token');

    }

    public function fetch_data($table, $where = null, $order = null){
        if ($where != null){
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        if ($order != null){
            $this->db->order_by('id', $order);
        }

       $result = $this->db->get($table);

        if($result->num_rows() > 0) {
            return $result->result();
        }else{
            return false;
        }
    }

    public function insertData($table, $data){

        if ($this->db->insert($table, $data)){

            return $this->db->insert_id();

        }
        return false;
    }

    public function updateData($table, $where, $nameWithValue){

        if (!empty($nameWithValue)){
            foreach ($nameWithValue as $key => $value){
                $this->db->set($key,$value);
            }
        }

        if (!empty($where)){
            foreach ($where as $key => $value){
                $this->db->where($key,$value);
            }
        }

        if($this->db->update($table)){
            return true;
        }

        return false;
    }

    public function deleteData($table, $where = null){
        if ($where != null){
            foreach ($where as $key => $value){
                $this->db->where($key, $value);
            }
        }
        if ($this->db->delete($table)){
            return true;
        }

        return false;
    }

    public function login($username , $password){

        if (filter_var($username,FILTER_VALIDATE_EMAIL)){

            $this->db->where('email', $username);

        }else{
            $this->db->where('username', $username);

        }

        $result = $this->db->get('customer_accounts');

        if ($result->num_rows() > 0 ){

            $resultData = $result->result()[0];

            if (password_verify((string)$password, (string)$resultData->password)) {

                return $resultData;

            }
        }

        return false;

    }

    public function passwordEncryption($password){

        return password_hash($password, PASSWORD_DEFAULT);

    }

    public function validateCSRF(){

        if ($this->csrf_token === $this->send_csrf_token){

            return true;

        }

        return false;

    }

    public function couponCodeValidate($couponCode){
        $this->db->where('couponCode',$couponCode)
            ->where('startDate < ', date('Y-m-d H:i:s'))
            ->where('endDate >', date('Y-m-d H:i:s'))
            ->where('useLimit >',0 )
            ->where('status', 1 );
        $result = $this->db->get('couponCode');

        if ($result->num_rows() > 0){
            return $result->result();
        }
        return false;
    }

    public function searchBox($table, $where, $search){
        $this->db->like($where, $search, 'after');
        $this->db->limit(5);
        $result = $this->db->get($table);
        if ($result->num_rows() > 0 ) {
            return $result->result();
        }
        return false;
    }

    public function outPutData(array $data){
        echo json_encode($data);
        exit();
    }

    public function invoiceProductList($id){
        $this->db->select('*')
            ->from('cartList')
            ->join('products', 'products.id = cartList.product_id')
            ->where('order_id',$id);
        $result = $this->db->get();
        if ($result){
            return $result->result();
        }
        return false;
    }

    public function pagination_fetch_data($table,$limit,$offset,$where=null){
        $this->db->select('*');
        $this->db->from($table);
        if ($where != null){
            foreach ($where as $key => $value){
                $this->db->where($key,$value);
            }
        }
        $this->db->limit($limit,$offset);
        $result = $this->db->get();
        if ($result){
            return $result->result();
        }
        return false;
    }

}