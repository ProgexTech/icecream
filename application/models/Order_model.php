<?php

class order_model extends CI_Model {
    
    public function insertOrder($orderData){
        $this->db->insert('order', $orderData);
    }
    
    public function getAllOrders(){
        $query = $this->db->query("SELECT * FROM `order`");
        $ret = $query->result_array();
        return $ret;
    }
}

