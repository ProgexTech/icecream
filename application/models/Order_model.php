<?php

class Order_model extends CI_Model {
    
    public function insertOrder($orderData){
        $this->db->insert('order', $orderData);
    }
    
    public function getAllOrdersByDecendingOder(){
        $query = $this->db->query("SELECT * FROM `order` ORDER BY createdDate desc");
        $ret = $query->result_array();
        return $ret;
    }
    
    public function getOrderById($orderId){
       $query = $this->db->query("SELECT * FROM `order` WHERE id = ".$orderId);
        $ret = $query->result_array();
        return $ret; 
    }
    
    public function getOrderByOrderNumber($orderNo){
       $query = $this->db->query("SELECT * FROM `order` WHERE orderNo = ".$orderNo);
        $ret = $query->result_array();
        return $ret; 
    }
    
     public function updateOrder($orderId, $data) {
        $condition = array(
            'id' => $orderId
        );
        $this->db->where($condition);
        $this->db->update('order', $data);
    }
    
    public function updateOrderStatus($orderId, $status){
        $condition = array(
            'id' => $orderId
        );
        
         $data = array(
            'status' => $status
        );

        $this->db->where($condition);
        $this->db->update('order', $data);
    }
    
    public function insertToOrderAudit($auditData){
        $this->db->insert('orderaudit', $auditData);
    }
}

