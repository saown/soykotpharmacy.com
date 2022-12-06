<?php
class OrderedProductListModel extends CI_Model{
    public function groupby($date){
        $this->db->select('productOrderLists.id, 
        cartList.product_id, 
        products.brand_name,
        products.brand_weight,
        products.brand_company_name,
        products.brand_generic_name,
        cartList.single_price,
        cartList.quantity_type,
        SUM(cartList.quantity) as quantity
        ')
            ->from('productOrderLists')
            ->where('orderDate', $date)
            ->join('cartList','cartList.order_id = productOrderLists.id')
            ->join('products', 'products.id = cartList.product_id')
            ->group_by('brand_name')
            ->group_by('quantity_type');

        $result = $this->db->get();

        if ($result->num_rows() > 0){
            return $result->result();
        }

        return false;
    }
}