<?php

class Order_model extends CI_Model {

    public function insertOrder($orderData) {
        $this->db->insert('order', $orderData);
    }

}