<?php

class order_model extends CI_Model {
    
    public function insertOrder($orderData){
        $this->db->insert('order', $orderData);
    }
    
    public function getAllOrdersByDecendingOder(){
        $query = $this->db->query("SELECT * FROM `order` ORDER BY date desc");
        $ret = $query->result_array();
        return $ret;
    }
}

